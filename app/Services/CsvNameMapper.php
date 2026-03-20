<?php

namespace App\Services;

class CsvNameMapper
{
    private const LAST_NAME_ALIASES = [
        'LastName',
        'last_name',
        'lastName',
        'lastname',
        'LN',
        'Surname',
        'FamilyName',
        'family_name',
    ];

    private const FIRST_NAME_ALIASES = [
        'FirstName',
        'first_name',
        'firstName',
        'firstname',
        'FN',
        'GivenName',
        'given_name',
    ];

    private const MIDDLE_NAME_ALIASES = [
        'MiddleInitial',
        'middle_initial',
        'MI',
        'MiddleName',
        'middle_name',
        'middlename',
    ];

    private const FULL_NAME_ALIASES = [
        'FullName',
        'full_name',
        'fullName',
        'fullname',
        'Name',
        'CompleteName',
    ];

    public static function map(array $record): array
    {
        $normalized = self::normalizedRecord($record);

        $fullName = self::firstNonEmpty($normalized, self::FULL_NAME_ALIASES);
        if ($fullName !== null) {
            $fullName = self::clean($fullName);

            return [
                'last_name' => null,
                'first_name' => null,
                'middle_name' => null,
                'full_name' => $fullName,
                'display_name' => $fullName,
            ];
        }

        $lastName = self::clean(self::firstNonEmpty($normalized, self::LAST_NAME_ALIASES));
        $firstName = self::clean(self::firstNonEmpty($normalized, self::FIRST_NAME_ALIASES));
        $middleName = self::clean(self::firstNonEmpty($normalized, self::MIDDLE_NAME_ALIASES));

        $middleInitial = self::toMiddleInitial($middleName);
        $displayName = self::formatDisplayName($lastName, $firstName, $middleInitial);

        return [
            'last_name' => $lastName,
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'full_name' => null,
            'display_name' => $displayName,
        ];
    }

    private static function normalizedRecord(array $record): array
    {
        $out = [];
        foreach ($record as $key => $value) {
            $normalizedKey = self::normalizeHeader((string) $key);
            if ($normalizedKey === '') {
                continue;
            }
            $out[$normalizedKey] = is_null($value) ? null : (string) $value;
        }

        return $out;
    }

    private static function firstNonEmpty(array $normalizedRecord, array $aliases): ?string
    {
        foreach ($aliases as $alias) {
            $key = self::normalizeHeader($alias);
            if (! array_key_exists($key, $normalizedRecord)) {
                continue;
            }

            $value = $normalizedRecord[$key];
            if ($value === null) {
                continue;
            }

            $value = self::clean($value);
            if ($value !== null) {
                return $value;
            }
        }

        return null;
    }

    private static function normalizeHeader(string $header): string
    {
        $header = strtolower($header);
        $header = preg_replace('/[^a-z0-9]+/', '', $header) ?? '';

        return $header;
    }

    private static function clean(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);
        $value = preg_replace('/\s+/', ' ', $value) ?? '';

        return $value === '' ? null : $value;
    }

    private static function toMiddleInitial(?string $middle): ?string
    {
        $middle = self::clean($middle);
        if ($middle === null) {
            return null;
        }

        $middle = rtrim($middle, '.');
        $middle = trim($middle);
        if ($middle === '') {
            return null;
        }

        $initial = mb_substr($middle, 0, 1);
        $initial = strtoupper($initial);

        return $initial === '' ? null : $initial;
    }

    private static function formatDisplayName(?string $last, ?string $first, ?string $middleInitial): ?string
    {
        $last = self::clean($last);
        $first = self::clean($first);
        $middleInitial = self::clean($middleInitial);

        if ($last !== null && $first !== null) {
            $out = $last.', '.$first;
            if ($middleInitial !== null) {
                $out .= ' '.$middleInitial.'.';
            }

            return $out;
        }

        if ($last !== null) {
            return $last;
        }

        if ($first !== null) {
            if ($middleInitial !== null) {
                return $first.' '.$middleInitial.'.';
            }

            return $first;
        }

        return null;
    }
}
