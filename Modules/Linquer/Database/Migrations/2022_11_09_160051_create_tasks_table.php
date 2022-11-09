<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Campaign\Entities\DestinationUrl;
use Modules\Linquer\Entities\Linquer;
use Modules\Linquer\Entities\Task;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Task::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_url_id')->nullable();
            $table->foreign('destination_url_id')->references('id')->on(DestinationUrl::getTableName())->onDelete('set null');
            $table->foreignId('linquer_id')->nullable();
            $table->foreign('linquer_id')->references('id')->on(Linquer::getTableName())->onDelete('set null');
            $table->string('status')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists(Task::getTableName());
    }
}
