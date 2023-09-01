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
        Schema::create('contrats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user')->index('contrats_id_user_foreign');
            $table->unsignedBigInteger('id_voiture')->index('contrats_id_voiture_foreign');
            $table->unsignedBigInteger('id_client')->index('contrats_id_client_foreign');
            $table->decimal('prix_uni');
            $table->decimal('prix_total');
            $table->date('date_debut');
            $table->date('date_fin');
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
        Schema::dropIfExists('contrats');
    }
};
