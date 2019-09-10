<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_inviting_id');
            $table->unsignedBigInteger('user_created_id')->nullable();
            $table->unsignedInteger('method_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_inviting_id')
                ->references('id')
                ->on('users');
            $table->foreign('user_created_id')
                ->references('id')
                ->on('users');
            $table->foreign('method_id')
                ->references('id')
                ->on('invitation_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
