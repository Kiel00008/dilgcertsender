<?php

use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CertificateController::class, 'index'])->name('certificates.index');
Route::post('/send', [CertificateController::class, 'send'])->name('certificates.send');
Route::post('/bulk', [CertificateController::class, 'send'])->name('certificates.bulk');
