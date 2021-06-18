<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('show_id');
            $table->foreignId('tag_id');
            
            $table->unique(['show_id', 'tag_id'],'show_tag_unique');

            $table->foreign('show_id')->references('id')->on('shows')
                    ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')
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
        Schema::dropIfExists('show_tag');
    }
}
