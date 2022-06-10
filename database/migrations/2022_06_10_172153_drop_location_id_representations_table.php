<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropLocationIdRepresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('representations', function (Blueprint $table) {
            $table->dropForeign('representations_location_id_foreign');
            $table->dropIndex('representations_location_id_foreign');
            $table->dropColumn('location_id');
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
            $table->foreignId('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')
                    ->onDelete('restrict')->onUpdate('cascade');
        });
    }
}
