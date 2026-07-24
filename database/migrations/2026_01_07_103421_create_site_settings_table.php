<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Tun Dr Mahathir');
            $table->string('site_tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->text('contact_email')->nullable();
            $table->text('contact_phone')->nullable();
            $table->text('contact_address')->nullable();
            $table->text('footer_text')->nullable();
            $table->string('primary_color')->default('#1e40af');
            $table->string('secondary_color')->default('#059669');
            $table->timestamps();
        });
}
};
