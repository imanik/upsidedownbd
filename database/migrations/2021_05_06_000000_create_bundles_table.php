<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->integer('regular_ticket_count')->default(0);
            $table->integer('child_ticket_count')->default(0);
            $table->decimal('normal_price', 11, 2)->default(0);
            $table->decimal('offer_price', 11, 2)->default(0);
            $table->enum('status', ['active', 'expired'])->default('active');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('facility_id')->nullable()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('bundles');
    }
}
