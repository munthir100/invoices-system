<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'active',
            'blocked',
            'new',
            'pending',
            'payed',
            'overdue',
        ];
        foreach ($statuses as $statusName) {
            Status::create(['name' => $statusName]);
        }
    }
}