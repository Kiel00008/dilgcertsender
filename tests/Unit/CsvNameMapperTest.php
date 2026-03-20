<?php

namespace Tests\Unit;

use App\Services\CsvNameMapper;
use PHPUnit\Framework\TestCase;

class CsvNameMapperTest extends TestCase
{
    public function test_merges_first_last_middle_initial_into_display_name(): void
    {
        $mapped = CsvNameMapper::map([
            'LastName' => 'Santos',
            'FirstName' => 'Maria',
            'MI' => 'L',
        ]);

        $this->assertSame('Santos, Maria L.', $mapped['display_name']);
        $this->assertSame('Santos', $mapped['last_name']);
        $this->assertSame('Maria', $mapped['first_name']);
        $this->assertSame('L', $mapped['middle_name']);
    }

    public function test_merges_without_middle_initial_when_missing(): void
    {
        $mapped = CsvNameMapper::map([
            'lastname' => 'Santos',
            'given_name' => 'Maria',
            'middle_initial' => ' ',
        ]);

        $this->assertSame('Santos, Maria', $mapped['display_name']);
    }

    public function test_full_name_wins_when_present(): void
    {
        $mapped = CsvNameMapper::map([
            'FullName' => 'Santos, Maria L.',
            'LastName' => 'Santos',
            'FirstName' => 'Maria',
            'MI' => 'L',
        ]);

        $this->assertSame('Santos, Maria L.', $mapped['display_name']);
        $this->assertSame('Santos, Maria L.', $mapped['full_name']);
        $this->assertNull($mapped['last_name']);
        $this->assertNull($mapped['first_name']);
        $this->assertNull($mapped['middle_name']);
    }

    public function test_trims_and_avoids_extra_punctuation(): void
    {
        $mapped = CsvNameMapper::map([
            'FamilyName' => '  Santos  ',
            'FN' => '  Maria  ',
            'MiddleName' => null,
        ]);

        $this->assertSame('Santos, Maria', $mapped['display_name']);
    }
}
