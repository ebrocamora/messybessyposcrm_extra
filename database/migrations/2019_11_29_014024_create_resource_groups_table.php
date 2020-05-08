<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_groups', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('application_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('icon')->default('list');
            $table->timestamps();

            $table->foreign('application_id')
                ->references('id')
                ->on('applications')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_groups');
    }
}
