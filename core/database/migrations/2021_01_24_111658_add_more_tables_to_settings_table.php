<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreTablesToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('messenger')->nullable();
            $table->text('disqus')->nullable();
            $table->text('add_this_status')->nullable();
            $table->text('facebook_pexel')->nullable();
            $table->text('google_analytics')->nullable();
            $table->string('announcement', 255)->nullable();
            $table->decimal('announcement_delay', 11, 2)->default(0.00);
            $table->text('maintainance_text')->nullable();
            $table->text('tawk_to')->nullable();
            $table->binary('cookie_alert_text')->nullable();

            $table->tinyInteger('is_messenger')->default(1);
            $table->tinyInteger('is_disqus')->default(1);
            $table->tinyInteger('is_google_analytics')->default(1);
            $table->tinyInteger('is_add_this_status')->default(1);
            $table->tinyInteger('is_facebook_pexel')->default(1);
            $table->tinyInteger('is_announcement')->default(1);
            $table->tinyInteger('is_maintainance_mode')->default(1);
            $table->tinyInteger('is_blog_share_links')->default(1);
            $table->tinyInteger('is_tawk_to')->default(1);

            $table->tinyInteger('is_speed_test')->default(1);
            $table->tinyInteger('is_cooki_alert')->default(1);
            $table->tinyInteger('is_about_section')->default(1);
            $table->tinyInteger('is_package_section')->default(1);
            $table->tinyInteger('is_offer_section')->default(1);
            $table->tinyInteger('is_counter_section')->default(1);
            $table->tinyInteger('is_service_section')->default(1);
            $table->tinyInteger('is_testimonial_section')->default(1);
            $table->tinyInteger('is_blog_section')->default(1);
            $table->tinyInteger('is_product_section')->default(1);
            $table->tinyInteger('is_contact_banner_section')->default(1);

            $table->tinyInteger('is_about_page')->default(1);
            $table->tinyInteger('is_media_page')->default(1);
            $table->tinyInteger('is_shop_page')->default(1);
            $table->tinyInteger('is_faq_page')->default(1);
            $table->tinyInteger('is_team_page')->default(1);
            $table->tinyInteger('is_branch_page')->default(1);
            $table->tinyInteger('is_blog_page')->default(1);
            $table->tinyInteger('is_contact_page')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'messenger', 
                'disqus',
                'add_this_status',
                'facebook_pexel',
                'google_analytics',
                'announcement',
                'announcement_delay',
                'maintainance_text',
                'tawk_to',
                'cookie_alert_text',
                'is_messenger',
                'is_disqus',
                'is_google_analytics',
                'is_add_this_status',
                'is_facebook_pexel',
                'is_announcement',
                'is_maintainance_mode',
                'is_blog_share_links',
                'is_tawk_to',
                'is_speed_test',
                'is_cooki_alert',
                'is_about_section',
                'is_package_section',
                'is_offer_section',
                'is_counter_section',
                'is_service_section',
                'is_testimonial_section',
                'is_blog_section',
                'is_product_section',
                'is_contact_banner_section',
                'is_about_page',
                'is_media_page',
                'is_shop_page',
                'is_faq_page',
                'is_team_page',
                'is_branch_page',
                'is_blog_page',
                'is_contact_page'
                ]);
        });
    }
}
