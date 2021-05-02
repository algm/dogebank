<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('from');
            $table->uuid('to');
            $table->float('amount');
            $table->string('status');
            $table->string('reason')->nullable()->default(null);

            $table->foreign('from')
                ->references('id')
                ->on('customers')
                ->restrictOnDelete();

            $table->foreign('to')
                ->references('id')
                ->on('customers')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
