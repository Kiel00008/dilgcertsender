<?php

namespace App\Http\Controllers;

use App\Mail\CertificateMail;
use App\Models\CertificateRecipient;
use App\Services\CsvNameMapper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class CertificateController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function send(Request $request)
    {
        $request->validate([
            'template' => 'required|image|max:5120',
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
            'fields_json' => 'required|string',
        ]);

        try {
            $templatePath = $request->file('template')->getRealPath();
            $templateData = base64_encode(file_get_contents($templatePath));
            $templateMime = $request->file('template')->getMimeType();
            $templateBase64 = 'data:'.$templateMime.';base64,'.$templateData;

            $fieldsConfig = json_decode($request->fields_json, true);
            if (! $fieldsConfig) {
                throw new \Exception('Invalid field configuration.');
            }

            $csv = Reader::createFromPath($request->file('csv_file')->getRealPath());
            $csv->setHeaderOffset(0);
            $records = $csv->getRecords();

            $successCount = 0;
            $errors = [];

            foreach ($records as $record) {
                $nameParts = CsvNameMapper::map($record);
                $recipientName = $nameParts['display_name'] ?? 'Recipient';

                $record['display_name'] = $recipientName;
                $record['name'] = $recipientName;

                $emailKey = $this->findKey($record, 'email');
                $email = $record[$emailKey] ?? '';

                if (empty($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'Invalid email for record: '.json_encode($record);

                    continue;
                }

                try {
                    CertificateRecipient::create([
                        'email' => $email,
                        'last_name' => $nameParts['last_name'],
                        'first_name' => $nameParts['first_name'],
                        'middle_name' => $nameParts['middle_name'],
                        'full_name' => $nameParts['full_name'],
                        'display_name' => $nameParts['display_name'],
                        'raw' => $record,
                    ]);
                } catch (\Exception $e) {
                    $errors[] = 'Failed to store recipient record for '.$email.': '.$e->getMessage();
                }

                $pdfFields = [];
                foreach ($fieldsConfig as $field) {
                    $csvKey = $this->findKey($record, $field['label']);
                    $pdfFields[] = [
                        'text' => $record[$csvKey] ?? $field['placeholder'],
                        'x' => $field['x'],
                        'y' => $field['y'],
                        'size' => $field['size'],
                        'color' => $field['color'],
                    ];
                }

                try {
                    $data = [
                        'template' => $templateBase64,
                        'fields' => $pdfFields,
                    ];

                    $pdf = Pdf::loadView('certificate', $data)
                        ->setPaper('a4', 'landscape');

                    $pdfPath = 'certificates/'.uniqid().'.pdf';
                    Storage::put($pdfPath, $pdf->output());

                    Mail::to($email)->send(new CertificateMail($recipientName, $pdfPath));
                    Storage::delete($pdfPath);
                    $successCount++;
                } catch (\Exception $e) {
                    $errors[] = 'Failed to send to '.$email.': '.$e->getMessage();
                }
            }

            $message = "Successfully sent {$successCount} certificates.";
            if (! empty($errors)) {
                $message .= ' Errors: '.count($errors).' failed.';
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Critical Error: '.$e->getMessage());
        }
    }

    private function findKey($record, $search)
    {
        // Try exact match
        if (array_key_exists($search, $record)) {
            return $search;
        }

        // Try case-insensitive match
        foreach ($record as $key => $value) {
            if (stripos($key, $search) !== false) {
                return $key;
            }
        }

        return $search;
    }
}
