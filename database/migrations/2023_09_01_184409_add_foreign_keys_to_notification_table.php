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
        Schema::table('notification', function (Blueprint $table) {
            $table->foreign(['id_contrat'])->references(['id'])->on('contrats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_user'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification', function (Blueprint $table) {
            $table->dropForeign('notification_id_contrat_foreign');
            $table->dropForeign('notification_id_user_foreign');
        });
    }
};
