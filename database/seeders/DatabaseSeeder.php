<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        DB::table('users')->insert([
            'name'       => 'Admin',
            'email'      => 'admin@blog.com',
            'password'   => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Categories
        DB::table('categories')->insert([
            ['name' => 'Admit Card', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Result',     'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sample Blogs
        DB::table('blogs')->insert([
            [
                'title'             => 'UPSC Admit Card 2024 Released',
                'short_description' => 'UPSC has released the admit card for the 2024 exam.',
                'content'           => 'The Union Public Service Commission has officially released the admit card for the 2024 Civil Services Examination. Candidates can download it from the official website using their registration number and date of birth.',
                'category_id'       => 1,
                'image'             => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'title'             => 'SSC CGL Result 2024 Announced',
                'short_description' => 'SSC CGL Result for 2024 has been officially announced.',
                'content'           => 'The Staff Selection Commission has announced the Combined Graduate Level Result for 2024. Candidates who appeared in the exam can check their results on the official SSC portal.',
                'category_id'       => 2,
                'image'             => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'title'             => 'RRB NTPC Admit Card Out',
                'short_description' => 'Railway Recruitment Board has released NTPC admit cards.',
                'content'           => 'The Railway Recruitment Board has released the admit cards for NTPC recruitment exam. Candidates can download their hall tickets from the regional RRB websites.',
                'category_id'       => 1,
                'image'             => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'title'             => 'IBPS PO Result 2024 Declared',
                'short_description' => 'IBPS has declared the PO exam result for 2024.',
                'content'           => 'The Institute of Banking Personnel Selection has declared the Probationary Officer exam result for 2024. Selected candidates will proceed to the interview round.',
                'category_id'       => 2,
                'image'             => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'title'             => 'NEET UG Admit Card 2024',
                'short_description' => 'NTA releases NEET UG admit card for 2024 examination.',
                'content'           => 'The National Testing Agency has released the NEET UG admit card for the 2024 examination. Students can download it from the NTA official website using their application number.',
                'category_id'       => 1,
                'image'             => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}