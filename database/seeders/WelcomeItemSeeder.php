<?php

namespace Database\Seeders;

use App\Models\WelcomeItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WelcomeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WelcomeItem::truncate();

        $welcome_item = new WelcomeItem();
        $welcome_item->heading = 'Welcome to TripSummit';
        $welcome_item->description = 'At TripSummit, our mission is to turn travel dreams into reality by providing personalized and memorable experiences. We leverage our expertise and trusted partners to ensure every trip is seamless and enjoyable. <br /> We believe travel fosters personal growth and cultural understanding. Our goal is to help clients explore new destinations and connect with diverse cultures. We promote sustainable travel to positively impact communities and preserve our planet’s beauty.';
        $welcome_item->button_text = 'Read More';
        $welcome_item->button_link = '#';
        $welcome_item->photo = 'about-1.jpg';
        $welcome_item->video_id = 'S4DI3Bve_bQ';
        $welcome_item->status = 'active';
        $welcome_item->save();
    }
}
