<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomIdRepresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('representations', function (Blueprint $table) {
            $table->foreignId('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')
                    ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('representations', function (Blueprint $table) {
            $table->dropForeign('representations_room_id_foreign');
            $table->dropIndex('representations_room_id_foreign');
            $table->dropColumn('room_id');
        });
    }
}
