<?php

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
    {
        $features =  [
            [
                'added_by'         => 1,
                'ar'          => [
                    'name'           => 'جاكوزي ',
                    'description'    => 'تفاصيل الجاكوزي ',
                ],
                'en'          => [
                    'name'           => 'jacuzzi',
                    'description'    => 'Jacuzzi details',
                ]
            ],       [
                'added_by'         => 1,
                'ar'          => [
                    'name'           => ' حمام بخار',
                    'description'    => 'تفاصيل حمام بخار',
                ],
                'en'          => [
                    'name'           => 'steam bath',
                    'description'    => 'Steam bath details',
                ]
            ],       [
                'added_by'         => 1,
                'ar'          => [
                    'name'           => 'يطل علي البحر ',
                    'description'    => 'تفاصيل المنظر الطبيعي',
                ],
                'en'          => [
                    'name'           => 'overlooking the sea',
                    'description'    => 'landscape details',
                ]
            ],
           
        ];


        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
    
}
