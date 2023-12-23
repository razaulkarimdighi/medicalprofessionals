<?php

use App\Models\User;
use App\Utils\GlobalConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->index()->nullable();
            // $table->string('middle_name')->index()->nullable();
            $table->string('last_name')->index()->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 25)->index()->nullable();
            $table->string('email')->index()->unique();
            // $table->string('date_of_hire')->nullable();
            // $table->string('department')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('permission')->default('pending');
            $table->string('status')->default('active');
            $table->string('user_type', 50)->index()->default(User::USER_TYPE_ADMIN);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            // $table->string('status', 50)->index()->default(GlobalConstant::STATUS_INACTIVE);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
