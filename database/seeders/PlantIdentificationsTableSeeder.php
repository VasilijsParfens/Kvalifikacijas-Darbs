<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PlantIdentificationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Number of posts to generate
        $numberOfPosts = 20;

        // Get all user IDs from the users table
        $userIds = DB::table('users')->pluck('id');

        // Example plant descriptions
        $plantDescriptions = [
            "Found this plant in my backyard. It has large, glossy leaves with white flowers. Can anyone help identify it?",
            "Saw this plant on a hike. It has small yellow flowers and spiky leaves. Any ideas?",
            "This plant is growing in my garden, but I didn't plant it. It has purple flowers and thick stems.",
            "Found this plant near a river. It has long, narrow leaves and small white berries.",
            "This plant has red flowers and grows in clusters. Can someone tell me what it is?",
            "I found this plant in a forest. It has heart-shaped leaves and tiny blue flowers.",
            "This plant is growing in a shady area. It has large, green leaves and no flowers.",
            "Found this plant in a park. It has small pink flowers and serrated leaves.",
            "This plant has thick, waxy leaves and orange flowers. Can anyone identify it?",
            "Found this plant in a desert area. It has small, spiky leaves and yellow flowers.",
            "This plant has long, trailing vines and small white flowers. What is it?",
            "Found this plant near a lake. It has large, round leaves and purple flowers.",
            "This plant has small, star-shaped flowers and grows in sandy soil.",
            "Found this plant in a meadow. It has tall stems and yellow flowers.",
            "This plant has fuzzy leaves and small pink flowers. Can anyone help?",
            "Found this plant in a rocky area. It has small, succulent leaves and no flowers.",
            "This plant has large, fan-shaped leaves and grows in clusters.",
            "Found this plant in a tropical garden. It has bright red flowers and glossy leaves.",
            "This plant has small, bell-shaped flowers and grows in shady areas.",
            "Found this plant in a wetland. It has long, grass-like leaves and small white flowers.",
        ];

        // Example plant images (paths to images)
        $plantImages = [
            'img/plant1.jpg',
            'img/plant2.jpg',
            'img/plant3.jpg',
            'img/plant4.jpg',
            'img/plant5.jpg',
            'img/plant6.jpg',
            'img/plant7.jpg',
            'img/plant8.jpg',
            'img/plant9.jpg',
            'img/plant10.jpg',
            'img/plant11.jpg',
            'img/plant12.jpg',
            'img/plant13.jpg',
            'img/plant14.jpg',
            'img/plant15.jpg',
            'img/plant16.jpg',
            'img/plant17.jpg',
            'img/plant18.jpg',
            'img/plant19.jpg',
            'img/plant20.jpg',
        ];

        for ($i = 0; $i < $numberOfPosts; $i++) {
            DB::table('posts')->insert([
                'user_id' => $faker->randomElement($userIds), // Random user ID
                'type' => 'plant_identification', // Type of post
                'title' => 'Unknown Plant Identification', // Optional title
                'content' => $plantDescriptions[$i], // Realistic plant description
                'image' => $plantImages[$i], // Path to plant image
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
