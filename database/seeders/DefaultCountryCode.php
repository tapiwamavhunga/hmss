<?php

namespace Database\Seeders;

use App\Models\SuperAdminSetting;
use Illuminate\Database\Seeder;

class DefaultCountryCode extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countryCodeExist = SuperAdminSetting::where('key', 'default_country_code')->exists();

        if (! $countryCodeExist) {
            SuperAdminSetting::create(['key' => 'default_country_code', 'value' => 'in']);
        }
    }
}
