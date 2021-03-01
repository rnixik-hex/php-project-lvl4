<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['новый', 'в работе', 'на тестировании', 'завершен'];
        $dataToInsert = [];
        foreach ($names as $name) {
            $dataToInsert[] = [
                'name' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('task_statuses')->insert($dataToInsert);
    }
}
