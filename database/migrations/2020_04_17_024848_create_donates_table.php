<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->char("trans_code");
            $table->char("user_id");
            $table->tinyInteger("state")->default(0);
            $table->integer("money")->default(0);//item_price
            $table->string("payment_name")->default("");
            $table->datetime("credit_time");
            $table->datetime("last_update");
            $table->string("user_mail_add")->default("");
            $table->string("user_name")->default("");
            $table->string("item_code")->default("");
            $table->string("item_name")->default("");
            $table->string("order_number")->default("");
            $table->string("st_code")->default("");
            $table->tinyInteger("pay_time")->default(0);
            $table->text("epsilon_info")->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donates');
    }
}
