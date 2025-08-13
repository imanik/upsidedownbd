<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('id');
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();

            $table->string('photo')->nullable();
            $table->enum('status', config('upsidedown.user.statuses'))->default('pending');

            $table->boolean('is_admin')->default(0);
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('cascade');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['photo', 'status', 'slug', 'mobile', 'address', 'is_admin', 'branch_id', 'role_id']);
        });
    }
}
