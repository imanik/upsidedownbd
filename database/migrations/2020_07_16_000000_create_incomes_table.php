<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('adult_ticket_count')->nullable();
            $table->integer('child_ticket_count')->nullable();
            $table->integer('discount_ticket_count')->nullable();
            $table->integer('dslr_type1_count')->nullable();
            $table->integer('dslr_type2_count')->nullable();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('account_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_id')->constrained("account_categories")->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('cc_sale', 11, 2)->default(0);
            $table->decimal('discount', 11, 2)->default(0);
            $table->decimal('total', 11, 2)->default(0);
            $table->decimal('grand_total', 11, 2)->default(0);
            $table->text('description')->nullable();
            $table->timestamp('date');
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
        Schema::dropIfExists('incomes');
    }
}
