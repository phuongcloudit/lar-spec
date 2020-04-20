<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_category_id');
            $table->string("name")->unique();
            $table->string("slug")->unique();
            $table->date("end_time");
            $table->string("thumbnail")->nullable();
            $table->text("galleries")->nullable();
            $table->longText("content")->nullable();
            $table->boolean('featured')->default(0);
            $table->enum("status",["publish","draft"])->default("publish");
            $table->integer("money")->default(0);
            $table->integer("donated")->default(0);
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('project_category_id')->references('id')->on('project_categories');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
