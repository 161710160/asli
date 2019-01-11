<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->string('slug');
        $table->text('description');
        $table->string('cover');
        $table->float('price');
        $table->integer('views')->default(0)->unsigned();
        $table->integer('stock')->default(0)->unsigned();
        $table->unsignedInteger('id_categories');
        $table->foreign('id_categories')->references('id')->on('categories')->onDelete('CASCADE');
        $table->enum('status', ['PUBLISH', 'DRAFT']);
        $table->integer('created_by');
        $table->integer('updated_by')->nullable();
        $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('produks');
    }
}
