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
        Schema::create('notification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_contrat')->index('notification_id_contrat_foreign');
            $table->string('description');
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger('id_user')->index('notification_id_user_foreign');
            $table->boolean('isOpen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification');
    }
};
