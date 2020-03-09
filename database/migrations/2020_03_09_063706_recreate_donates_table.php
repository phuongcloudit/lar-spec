<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateDonatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('donates');
        Schema::create('donates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id');
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
        Schema::dropIfExists('donates');
        Schema::create('donates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id');
            $table->string("eps_item_code")->default("");
            $table->string("eps_item_name")->default("");
            $table->integer("money")->default(0);
            $table->enum('status', ["draft","success","error"])->default("draft");
            $table->char("eps_user_id",10)->default("");
            $table->string("eps_user_name")->default("");
            $table->string("eps_email")->default("");
            $table->char("eps_order_number",10)->default("");
            $table->string("eps_payment_code")->default("");
            $table->tinyInteger("eps_mission_code")->default(1);
            $table->tinyInteger("eps_process_code")->default(1);
            $table->string("eps_memo1")->default("");
            $table->string("eps_memo2")->default("");
            $table->string("eps_redirect")->default("");
            $table->boolean("is_xml_error")->default(0);
            $table->string("xml_error_cd")->default("");
            $table->string("xml_error_msg")->default("");
            $table->string("xml_memo1_msg")->default("");
            $table->string("xml_memo2_msg")->default("");
            $table->string("eps_result")->default("");
            $table->char("trans_code")->default("");
            $table->timestamps();
        });
    }
}
