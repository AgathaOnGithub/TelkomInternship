<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('internship_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('internship_id')->nullable(); // Menambahkan foreign key
            $table->foreign('internship_id')->references('id')->on('internships')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('internship_registrations', function (Blueprint $table) {
            $table->dropForeign(['internship_id']);
            $table->dropColumn('internship_id');
        });
    }
    
};
