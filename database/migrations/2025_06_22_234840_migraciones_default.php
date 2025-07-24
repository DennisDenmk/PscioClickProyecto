<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20)->unique();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('apellido',30);
            $table->string('cedula', 10)->unique();
            $table->string('email')->unique();
            $table->string('telefono', 10)->unique();
            $table->timestamp('email_verified_at')->default(now());
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles');
            $table->boolean('estado')->default(true);
            $table->string('rememberToken', 100)->default('');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->default(now());
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();

            // Cambiar foreignId por string ya que cedula es string
            $table->string('user_id')->nullable(); // nullable para usuarios no autenticados

            $table->string('ip_address', 45)->nullable(); // también nullable
            $table->text('user_agent')->nullable(); // también nullable
            $table->longText('payload');
            $table->integer('last_activity')->index();

            // Foreign key hacia users.cedula (si lo necesitas)
            $table->foreign('user_id')->references('cedula')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
