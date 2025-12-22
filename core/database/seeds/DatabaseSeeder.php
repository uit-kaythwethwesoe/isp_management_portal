<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // Admin table Seeding
        DB::table('admins')->insert(
            [
                'name' => "Admin",
                'username' => "admin",
                'image' => "admin.jpg",
                'role' => "1",
                'email' => "admin@gmail.com",
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );
        // Language table Seeding
        DB::table('languages')->insert(
            [
                'name' => "English",
                'code' => "en",
                'is_default' => "1",
                'direction' => "ltr",
            ]
        );
        // Language table Seeding
        DB::table('settings')->insert(
            [
                'language_id' => "1",
                'website_title' => "website_title",
                'base_color' => "983ce9",
                'header_logo' => "header_logo",
                'footer_logo' => "footer_logo",
                'fav_icon' => "fav_icon",
                'breadcrumb_image' => "breadcrumb_image",
                'number' => "number",
                'email' => "email",
                'contactemail' => "contactemail",
                'address' => "address",
                'footer_text' => "footer_text",
                'meta_keywords' => "meta_keywords",
                'meta_description' => "meta_description",
                'copyright_text' => "copyright_text",
                'google_recaptcha_site_key' => "google_recaptcha_site_key",
                'google_recaptcha_secret_key' => "google_recaptcha_secret_key",
                'is_recaptcha' => "0",
            ]
        );
        // Email table Seeding
        DB::table('emailsettings')->insert(
            [
                'is_smtp' => "1",
                'header_email' => "smtp",
                'is_verification_email' => "1",
            ]
        );
        // Currencies table Seeding
        DB::table('currencies')->insert(
            [
                'name' => "USD",
                'sign' => "$",
                'value' => "1",
                'is_default' => "1",
            ]
        );
        // Section Title table Seeding
        DB::table('sectiontitles')->insert(
            [
                'language_id' => "1",
                'about_title' => "about_title",
                'about_subtitle' => "about_subtitle",
                'plan_title' => "plan_title",
                'plan_subtitle' => "plan_subtitle",
                'offer_title' => "offer_title",
                'offer_subtitle' => "offer_subtitle",
                'service_title' => "service_title",
                'service_subtitle' => "service_subtitle",
                'entertainment_title' => "entertainment_title",
                'entertainment_subtitle' => "entertainment_subtitle",
                'media_zone_title' => "media_zone_title",
                'media_zone_subtitle' => "media_zone_subtitle",
                'contact_title' => "contact_title",
                'contact_subtitle' => "contact_subtitle",
                'media_title' => "media_title",
                'branch_title' => "branch_title",
                'team_title' => "team_title",
                'gallery_title' => "gallery_title",
                'shop_title' => "shop_title",
                'about_image' => "about_image",
                'offer_image' => "offer_image",
            ]
        );
        // Payment Getway table Seeding
        DB::table('payment_gateweys')->insert(
            [
                'title' => "Stripe",
                'image' => "image",
                'name' => "Stripe",
                'type' => "automatic",
                'information' => '{"key":"test","secret":"test","text":"Pay Via Stripe"}',
                'keyword' => "stripe",
                'status' => "1",
            ]
        );
        DB::table('payment_gateweys')->insert(
            [
                'title' => "Paypal",
                'image' => "image",
                'name' => "Paypal",
                'type' => "automatic",
                'information' => '{"client_id":"test","client_secret":"test","sandbox_check":1,"text":"Pay via your PayPal account."}',
                'keyword' => "paypal",
                'status' => "1",
            ]
        );

    }
}
