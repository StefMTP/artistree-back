<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['artist', 'contributor', 'follower'])->after('password');
            $table->string('first_name')->after('role');
            $table->string('last_name')->after('first_name');
            $table->enum('gender', ['Male', 'Female', 'Other'])->after('last_name')->nullable();
            $table->string('phone')->after('gender')->nullable();
            $table->string('location')->after('phone')->nullable();
            $table->string('specialty')->after('location')->nullable();
            $table->text('bio')->after('specialty')->nullable();
            $table->string('avatar_url')->after('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
