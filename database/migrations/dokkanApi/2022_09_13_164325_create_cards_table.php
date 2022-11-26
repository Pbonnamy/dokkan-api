<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->integer('dokkan_id')->unique();
            $table->string('name');
            $table->string('image');
            $table->integer('cost')->nullable();

            $table->integer('hp_init')->nullable();
            $table->integer('hp_max')->nullable();
            $table->integer('hp_eza')->nullable();

            $table->integer('atk_init')->nullable();
            $table->integer('atk_max')->nullable();
            $table->integer('atk_eza')->nullable();

            $table->integer('def_init')->nullable();
            $table->integer('def_max')->nullable();
            $table->integer('def_eza')->nullable();

            $table->string('leader_skill')->nullable();
            $table->text('passive_skill')->nullable();
            $table->string('leader_skill_eza')->nullable();
            $table->text('passive_skill_eza')->nullable();

            $table->boolean('has_eza')->default(false);

            $table->foreignId('type_id')->constrained();
            $table->foreignId('element_id')->constrained();
            $table->foreignId('rarity_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
