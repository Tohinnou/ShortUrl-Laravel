<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->string('hash');
            $table->string('shortUrl');
            $table->string('longUrl');
            $table->string('domain');
            $table->timestamps();
        });

        Schema::table('urls', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
        Schema::table('urls', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
        });
    }
};
