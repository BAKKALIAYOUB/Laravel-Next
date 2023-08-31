<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdRoleFromUsersAndRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Supprimer la clé étrangère de la table "users"
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_role']);
        });

        // Supprimer la colonne "id_role" de la table "users"
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id_role');
        });

        // Supprimer la colonne "id_role" de la table "roles"
        Schema::table('role', function (Blueprint $table) {
            $table->dropColumn('id_role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_and_roles', function (Blueprint $table) {
            //
        });
    }
}
