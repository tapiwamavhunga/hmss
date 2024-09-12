<?php

namespace Database\Seeders;

use App\Models\SectionFive;
use Illuminate\Database\Seeder;

class LandingSectionFiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            'main_img_url' => ('/assets/landing-theme/images/about/07.svg'),
            'card_img_url_one' => ('/assets/landing-theme/images/banner/card_img_url_one.png'),
            'card_img_url_two' => ('/assets/landing-theme/images/banner/card_img_url_two.png'),
            'card_img_url_three' => ('/assets/landing-theme/images/banner/card_img_url_three.png'),
            'card_img_url_four' => ('/assets/landing-theme/images/banner/card_imf_url_four.png'),
            'card_one_number' => 234,
            'card_two_number' => 455,
            'card_three_number' => 365,
            'card_four_number' => 528,
            'card_one_text' => 'Services',
            'card_two_text' => 'Team Members',
            'card_three_text' => 'Happy Patients',
            'card_four_text' => 'Tonic Research',
        ];

        SectionFive::create($input);
    }
}
