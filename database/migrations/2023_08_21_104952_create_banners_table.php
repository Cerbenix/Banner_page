<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('url');
            $table->enum('target_type', ['same_window', 'new_window']);
            $table->integer('position');
            $table->integer('views_count')->default(0); // New column
            $table->integer('clicks_count')->default(0); // New column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
