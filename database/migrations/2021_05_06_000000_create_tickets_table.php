<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->integer('regular_ticket_count')->nullable();
            $table->integer('child_ticket_count')->nullable();
            $table->integer('regular_ticket_price')->nullable();
            $table->integer('child_ticket_price')->nullable();
            $table->decimal('sub_total', 11, 2)->default(0);
            $table->decimal('discount', 11, 2)->default(0);
            $table->decimal('total', 11, 2)->default(0);
            $table->decimal('vat', 11, 2)->default(0);
            $table->decimal('grand_total', 11, 2)->default(0);
            $table->enum('status', ['visited', 'not-visited'])->default('not-visited');
            $table->text('photos_link')->nullable();
            $table->foreignId('slot_id')->constrained()->onDelete('cascade');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('volunteer_id')->nullable()->constrained('employees')->onDelete('cascade');
            $table->foreignId('facility_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('facility_provider_id')->nullable()->constrained('employees')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('bundle_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamp('date')->nullable();
            $table->timestamp('visited_at')->nullable();
            $table->enum('payment_status', ['unpaid', 'partial', 'paid', 'refunded'])->default('unpaid');
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
        Schema::dropIfExists('tickets');
    }
}
