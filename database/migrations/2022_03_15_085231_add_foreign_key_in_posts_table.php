<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
            ->after('slug');
            // indichiamo che user_id è una foreign key, che fa riferimento alla colonna id della tabella users
            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            // VERSIONE CORTA
            // il nome della colonna dovrà contenere il nome della
            // tabella di destinazione al singolare + il nome della colonna
            // a cui fa riferimento:

            // $table->foreignId('user_id')
            // ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // prima di cancellare la colonna devo togliere
            // anche il collegamento (foreign key)
            $table->dropForeign('posts_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
