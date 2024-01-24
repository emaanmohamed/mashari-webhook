<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name_en' => 'United States',
                'name_ar' => 'الولايات المتحدة',
                'description_en' => 'Description for United States in English',
                'description_ar' => 'وصف للولايات المتحدة باللغة العربية',
            ],
            [
                'name_en' => 'France',
                'name_ar' => 'فرنسا',
                'description_en' => 'Description for France in English',
                'description_ar' => 'وصف لفرنسا باللغة العربية',
            ],
            [
                'name_en' => 'Germany',
                'name_ar' => 'ألمانيا',
                'description_en' => 'Description for Germany in English',
                'description_ar' => 'وصف لألمانيا باللغة العربية',
            ],
            [
                'name_en' => 'Italy',
                'name_ar' => 'إيطاليا',
                'description_en' => 'Description for Italy in English',
                'description_ar' => 'وصف لإيطاليا باللغة العربية',
            ],
            [
                'name_en' => 'Spain',
                'name_ar' => 'إسبانيا',
                'description_en' => 'Description for Spain in English',
                'description_ar' => 'وصف لإسبانيا باللغة العربية',
            ],
            [
                'name_en' => 'Canada',
                'name_ar' => 'كندا',
                'description_en' => 'Description for Canada in English',
                'description_ar' => 'وصف لكندا باللغة العربية',
            ],
            [
                'name_en' => 'Australia',
                'name_ar' => 'أستراليا',
                'description_en' => 'Description for Australia in English',
                'description_ar' => 'وصف لأستراليا باللغة العربية',
            ],
            [
                'name_en' => 'Brazil',
                'name_ar' => 'البرازيل',
                'description_en' => 'Description for Brazil in English',
                'description_ar' => 'وصف للبرازيل باللغة العربية',
            ],
            [
                'name_en' => 'China',
                'name_ar' => 'الصين',
                'description_en' => 'Description',
                'description_ar' => 'وصف',
            ]

        ];

        foreach ($countries as $countryData) {
            Country::create($countryData);
        }
    }
}
