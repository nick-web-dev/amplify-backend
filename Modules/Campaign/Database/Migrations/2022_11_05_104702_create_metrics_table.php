<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\Metrics;

class CreateMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Metrics::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->nullable();
            $table->foreign('campaign_id')->references('id')->on(Campaign::getTableName())->onDelete('cascade');

            $table->string('category_1')->nullable();
            $table->string('category_2')->nullable();
            $table->text('keywords')->nullable();
            $table->string('domain_authority')->nullable();
            $table->integer('minimum_traffic')->default(0);
            $table->string('content_approval')->nullable();

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
        Schema::dropIfExists(Metrics::getTableName());
    }
}
