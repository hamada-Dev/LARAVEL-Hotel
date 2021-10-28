<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types =  [

            [
                'added_by'         => 1,
                'ar'          => [
                    'name'           => ' غرفه  فرديه',
                    'description'    => ' تفاصيل الغرفه  فرديه',
                ],
                'en'          => [
                    'name'           => 'Single room',
                    'description'    => 'Single room details',
                ]
                ], [
                'added_by'         => 1,
                'ar'          => [
                    'name'           => 'جناح ',
                    'description'    => 'تفاصيل الجناح',
                ],
                'en'          => [
                    'name'           => 'suite',
                    'description'    => 'suite details',
                ]
                ], [
                'added_by'         => 1,
                'ar'          => [
                    'name'           => 'غرفه  زوجييه ',
                    'description'    => 'تفاصيل الغرفه  زوجييه',
                ],
                'en'          => [
                    'name'           => 'double room',
                    'description'    => 'Double room details',
                ]
                ],
        ];


        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
