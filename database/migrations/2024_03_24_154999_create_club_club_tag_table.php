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
        Schema::create('club_club_tag', function (Blueprint $table) {
            $table->foreignId("club_id")->constrained()->onDelete("cascade");
            $table->foreignId("club_tag_id")->constrained()->onDelete("cascade");
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_club_tag');
    }


};
