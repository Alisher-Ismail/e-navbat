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
        Schema::create('navbat', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('sana');
            $table->string('vaqt');
            $table->string('ism');
            $table->string('tel');
            $table->string('maqsad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('navbat');
    }
};
