<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecruiterToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('recruiter_avatar')->nullable()->after("content");
            $table->string('recruiter_name')->nullable()->after("recruiter_avatar");
            $table->text('recruiter_content')->nullable()->after("recruiter_name");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('recruiter_content');
            $table->dropColumn('recruiter_name');
            $table->dropColumn('recruiter_avatar');
        });
    }
}
