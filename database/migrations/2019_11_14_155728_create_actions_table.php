<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->set('type', ['call', 'visit']);
			$table->string('phone_no',30)->nullable();
			$table->text('details');
			$table->string('slug');
			$table->bigInteger('customer_id', false, true);
			$table->bigInteger('user_id', false, true);
            $table->timestamps();
			
			$table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //Check witch user create action
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
