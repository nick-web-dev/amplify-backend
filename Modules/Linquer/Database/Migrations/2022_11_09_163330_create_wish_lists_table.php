<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Linquer\Entities\Task;
use Modules\Linquer\Entities\WishList;

class CreateWishListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(WishList::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->nullable();
            $table->foreign('task_id')->references('id')->on(Task::getTableName())->onDelete('cascade');
            $table->string('source_link')
                ->comment('this link the linquer will select from elastic search data in linquer management system dashboard');
            $table->enum('status', ['draft', 'approved'])
                ->comment('Draft, if linquer did not approve it, approved: linquer selected it and passed to next step');

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
        Schema::dropIfExists(WishList::getTableName());
    }
}
