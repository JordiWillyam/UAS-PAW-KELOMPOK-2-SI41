<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Mengganti first_name dan last_name dengan name
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number'); // Menambahkan kolom nomor telepon
            $table->enum('gender', ['male', 'female']); // Menambahkan kolom gender
            $table->string('address'); // Menambahkan kolom alamat
            $table->date('date_of_birth'); // Menambahkan kolom tanggal lahir
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
