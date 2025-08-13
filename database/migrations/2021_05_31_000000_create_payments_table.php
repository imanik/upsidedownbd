<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->nullable();
            $table->enum('type', ['Ticket', 'Bundle'])->default('Ticket');
            $table->enum('status', ['Pending', 'Initiated', 'Processing', 'Failed', 'Complete', 'Canceled'])->default('Pending');
            $table->string('tran_id')->nullable();
            $table->string('currency')->nullable();
            $table->text('post_data')->nullable();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
