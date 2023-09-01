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
        Schema::table('contrats', function (Blueprint $table) {
            $table->foreign(['id_client'])->references(['id'])->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_user'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_voiture'])->references(['id'])->on('voitures')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contrats', function (Blueprint $table) {
            $table->dropForeign('contrats_id_client_foreign');
            $table->dropForeign('contrats_id_user_foreign');
            $table->dropForeign('contrats_id_voiture_foreign');
        });
    }
};
