<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_category_id')->nullable();
            $table->unsignedBigInteger('report_type_id')->nullable();
            $table->string("title")->unique();
            $table->string("slug")->unique();
            $table->longText("content")->nullable();
            $table->date("date");
            $table->enum("status",["publish","draft"])->default("publish");
            $table->string("thumbnail")->nullable();
            $table->boolean('featured')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->string("author")->nullable();
            $table->integer('view_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('project_category_id')->references('id')->on('project_categories');
            $table->foreign('report_type_id')->references('id')->on('report_types');
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
        Schema::dropIfExists('reports');
    }
}
