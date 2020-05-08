<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('application_id');
            $table->uuid('resource_group_id')->nullable();
            $table->uuid('parent_link_id')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('url');
            $table->string('icon')->default('list');
            $table->string('active_pattern');
            $table->unsignedInteger('order')->default(0);
            $table->string('status')->default('On');
            $table->uuid('permission_id')->nullable();
            $table->timestamps();

            $table->foreign('application_id')
                ->references('id')
                ->on('applications')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('resource_group_id')
                ->references('id')
                ->on('resource_groups')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
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
        Schema::dropIfExists('links');
    }
}
