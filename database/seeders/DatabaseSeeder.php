<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(
            function () {
                // Insert John Doe into the users table
                DB::table('users')->insert([
                    'id' => 1,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'username' => 'johndoe',
                    'email' => 'john.doe@example.com',
                    'password' => Hash::make('password'),
                    'biography' => "Hello i'm John",
                    'created_at' => new \DateTime('2026-02-09 10:00:00'),
                    'updated_at' => new \DateTime('2026-02-09 10:00:00'),
                ]);

                // Insert Jane Doe into the users table
                DB::table('users')->insert([
                    'id' => 2,
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                    'username' => 'janedoe',
                    'email' => 'jane.doe@example.com',
                    'password' => Hash::make('password'),
                    'biography' => "Hello i'm Jane",
                    'created_at' => new \DateTime('2026-02-09 11:00:00'),
                    'updated_at' => new \DateTime('2026-02-09 11:00:00'),
                ]);

                // Insert Pierre Martin - même préférences que John
                DB::table('users')->insert([
                    'id' => 3,
                    'first_name' => 'Pierre',
                    'last_name' => 'Martin',
                    'username' => 'pierre_martin',
                    'email' => 'pierre.martin@example.com',
                    'password' => Hash::make('password'),
                    'biography' => "Hello i'm Pierre",
                    'created_at' => new \DateTime('2026-02-09 13:00:00'),
                    'updated_at' => new \DateTime('2026-02-09 13:00:00'),
                ]);

                // Insert points for each user
                DB::table('points')->insert([
                    ['user_id' => 1, 'points' => 5, 'created_at' => new \DateTime('2026-02-09 10:00:00'), 'updated_at' => new \DateTime('2026-02-09 10:00:00')],
                    ['user_id' => 2, 'points' => 5, 'created_at' => new \DateTime('2026-02-09 11:00:00'), 'updated_at' => new \DateTime('2026-02-09 11:00:00')],
                    ['user_id' => 3, 'points' => 5, 'created_at' => new \DateTime('2026-02-09 13:00:00'), 'updated_at' => new \DateTime('2026-02-09 13:00:00')],
                ]);

                // Insert 6 questions
                DB::table('questions')->insert([
                    [
                        'question' => 'Milk before or after cereales?',
                        'option_a' => 'Milk before',
                        'option_b' => 'Milk after',
                        'created_at' => new \DateTime('2026-02-09 10:00:00'),
                        'updated_at' => new \DateTime('2026-02-09 10:00:00'),
                    ],
                    [
                        'question' => 'Shower on evening or on morning?',
                        'option_a' => 'Evening',
                        'option_b' => 'Morning',
                        'created_at' => new \DateTime('2026-02-09 10:00:00'),
                        'updated_at' => new \DateTime('2026-02-09 10:00:00'),
                    ],
                    [
                        'question' => 'More mountains or beach?',
                        'option_a' => 'Mountains',
                        'option_b' => 'Beach',
                        'created_at' => new \DateTime('2026-02-09 10:00:00'),
                        'updated_at' => new \DateTime('2026-02-09 10:00:00'),
                    ],
                    [
                        'question' => 'Are you more homebody or be outside?',
                        'option_a' => 'Homebody',
                        'option_b' => 'Be outside',
                        'created_at' => new \DateTime('2026-02-09 10:00:00'),
                        'updated_at' => new \DateTime('2026-02-09 10:00:00'),
                    ],
                    [
                        'question' => 'Do you prefer Windows or Mac?',
                        'option_a' => 'Windows',
                        'option_b' => 'Mac',
                        'created_at' => new \DateTime('2026-02-09 10:00:00'),
                        'updated_at' => new \DateTime('2026-02-09 10:00:00'),
                    ],
                    [
                        'question' => 'Do you validate tap shoes and socks?',
                        'option_a' => 'Yes',
                        'option_b' => 'No',
                        'created_at' => new \DateTime('2026-02-09 10:00:00'),
                        'updated_at' => new \DateTime('2026-02-09 10:00:00'),
                    ],
                ]);

                // John's answers (a, b, a, b, a, b)
                DB::table('user_answers')->insert([
                    ['user_id' => 1, 'question_id' => 1, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 10:05:00'), 'updated_at' => new \DateTime('2026-02-09 10:05:00')],
                    ['user_id' => 1, 'question_id' => 2, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 10:05:00'), 'updated_at' => new \DateTime('2026-02-09 10:05:00')],
                    ['user_id' => 1, 'question_id' => 3, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 10:05:00'), 'updated_at' => new \DateTime('2026-02-09 10:05:00')],
                    ['user_id' => 1, 'question_id' => 4, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 10:05:00'), 'updated_at' => new \DateTime('2026-02-09 10:05:00')],
                    ['user_id' => 1, 'question_id' => 5, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 10:05:00'), 'updated_at' => new \DateTime('2026-02-09 10:05:00')],
                    ['user_id' => 1, 'question_id' => 6, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 10:05:00'), 'updated_at' => new \DateTime('2026-02-09 10:05:00')],
                ]);

                // Jane's answers (b, a, b, a, b, a) - différentes de John
                DB::table('user_answers')->insert([
                    ['user_id' => 2, 'question_id' => 1, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 11:05:00'), 'updated_at' => new \DateTime('2026-02-09 11:05:00')],
                    ['user_id' => 2, 'question_id' => 2, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 11:05:00'), 'updated_at' => new \DateTime('2026-02-09 11:05:00')],
                    ['user_id' => 2, 'question_id' => 3, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 11:05:00'), 'updated_at' => new \DateTime('2026-02-09 11:05:00')],
                    ['user_id' => 2, 'question_id' => 4, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 11:05:00'), 'updated_at' => new \DateTime('2026-02-09 11:05:00')],
                    ['user_id' => 2, 'question_id' => 5, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 11:05:00'), 'updated_at' => new \DateTime('2026-02-09 11:05:00')],
                    ['user_id' => 2, 'question_id' => 6, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 11:05:00'), 'updated_at' => new \DateTime('2026-02-09 11:05:00')],
                ]);

                // Pierre's answers - IDENTIQUES à John (a, b, a, b, a, b)
                DB::table('user_answers')->insert([
                    ['user_id' => 3, 'question_id' => 1, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 13:05:00'), 'updated_at' => new \DateTime('2026-02-09 13:05:00')],
                    ['user_id' => 3, 'question_id' => 2, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 13:05:00'), 'updated_at' => new \DateTime('2026-02-09 13:05:00')],
                    ['user_id' => 3, 'question_id' => 3, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 13:05:00'), 'updated_at' => new \DateTime('2026-02-09 13:05:00')],
                    ['user_id' => 3, 'question_id' => 4, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 13:05:00'), 'updated_at' => new \DateTime('2026-02-09 13:05:00')],
                    ['user_id' => 3, 'question_id' => 5, 'answer' => 'a', 'created_at' => new \DateTime('2026-02-09 13:05:00'), 'updated_at' => new \DateTime('2026-02-09 13:05:00')],
                    ['user_id' => 3, 'question_id' => 6, 'answer' => 'b', 'created_at' => new \DateTime('2026-02-09 13:05:00'), 'updated_at' => new \DateTime('2026-02-09 13:05:00')],
                ]);

                // Insert some posts for John Doe
                DB::table('posts')->insert([
                    [
                        'id' => 1,
                        'user_id' => 1,
                        'title' => "John's First Post",
                        'content' => "This is the content of John's first post.",
                        'created_at' => new \DateTime('2026-02-09 12:00:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:00:00'),
                    ],
                    [
                        'id' => 2,
                        'user_id' => 1,
                        'title' => null,
                        'content' => "This is the content of John's second post.",
                        'created_at' => new \DateTime('2026-02-09 12:05:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:05:00'),
                    ],
                    [
                        'id' => 3,
                        'user_id' => 1,
                        'title' => null,
                        'content' => "This is the content of John's third post.",
                        'created_at' => new \DateTime('2026-02-09 12:10:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:10:00'),
                    ]
                ]);

                // Insert some posts for Jane Doe
                DB::table('posts')->insert([
                    [
                        'id' => 4,
                        'user_id' => 2,
                        'title' => null,
                        'content' => "This is the content of Jane's first post.",
                        'created_at' => new \DateTime('2026-02-09 12:05:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:05:00'),
                    ],
                    [
                        'id' => 5,
                        'user_id' => 2,
                        'title' => "Jane's Second Post",
                        'content' => "This is the content of Jane's second post.",
                        'created_at' => new \DateTime('2026-02-09 12:10:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:10:00'),
                    ],
                    [
                        'id' => 6,
                        'user_id' => 2,
                        'title' => "Jane's Third Post",
                        'content' => "This is the content of Jane's third post.",
                        'created_at' => new \DateTime('2026-02-09 12:15:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:15:00'),
                    ]
                ]);

                // Insert some likes for John's posts
                DB::table('likes')->insert([
                    [
                        'user_id' => 2,
                        'post_id' => 1,
                        'reaction' => 'like',
                        'created_at' => new \DateTime('2026-02-09 12:20:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:20:00'),
                    ],
                    [
                        'user_id' => 1, // John likes his own post
                        'post_id' => 2,
                        'reaction' => 'love',
                        'created_at' => new \DateTime('2026-02-09 12:25:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:25:00'),
                    ],
                ]);

                // Insert some likes for Jane's posts
                DB::table('likes')->insert([
                    [
                        'user_id' => 1,
                        'post_id' => 4,
                        'reaction' => 'like',
                        'created_at' => new \DateTime('2026-02-09 12:30:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:30:00'),
                    ],
                    [
                        'user_id' => 1,
                        'post_id' => 5,
                        'reaction' => 'love',
                        'created_at' => new \DateTime('2026-02-09 12:35:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:35:00'),
                    ],
                    [
                        'user_id' => 2, // Jane likes her own post
                        'post_id' => 5,
                        'reaction' => 'wow',
                        'created_at' => new \DateTime('2026-02-09 12:40:00'),
                        'updated_at' => new \DateTime('2026-02-09 12:40:00'),
                    ]
                ]);
            }
        );
    }
}
