<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',100);
            $table->string('opening_hour',50);
            $table->string('email');
            $table->string('whatsapp',50);
            $table->string('support',50);
            $table->text('google_map');
            $table->text('address');
            $table->integer('post_code')->default('0');
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('favicon_path')->nullable();
            $table->text('metadata_google_webmaster_tool')->nullable();
            $table->text('metadata_google_analytic')->nullable();
            $table->smallInteger('tax_vat')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_profiles');
    }
}
