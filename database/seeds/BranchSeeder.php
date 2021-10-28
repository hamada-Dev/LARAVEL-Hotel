<?php

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches =  [
            [
                'lat'              => 12.35878,
                'lng'              => 12.35878,
                'added_by'         => 1,
                'ar'          => [
                    'name'           => 'فرع مدينه نصر ',
                    'address'        => ' 15 شارع النعمان ',
                    'description'    => 'الفرع الاول من الفندق 5 نجوم',
                ],
                'en'          => [
                    'name'           => 'Nasr City Branch',
                    'address'        => '15 Numan Street',
                    'description'    => 'The first branch of the hotel is 5 stars',
                ]
            ],
            [
                'lat'              => 13.35878,
                'lng'              => 15.35878,
                'added_by'         => 1,
                'ar'          => [
                    'name'           => ' فرع مدينه العاشر ',
                    'address'        => ' ١٥ شارع الملك ',
                    'description'    => 'الفرع الثاني من الفندق 5 نجوم',
                ],
                'en'          => [
                    'name'           => '10th City Branch',
                    'address'        => '15 King Street',
                    'description'    => 'The second branch of the hotel is 5 stars',
                ]
            ]
        ];


        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
