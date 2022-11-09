<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\DestinationUrl;
use Modules\Campaign\Entities\Metrics;

class CreateDestinationUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DestinationUrl::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->nullable();
            $table->foreign('campaign_id')->references('id')->on(Campaign::getTableName())->onDelete('cascade');
            $table->foreignId('metrics_id')->nullable();
            $table->foreign('metrics_id')->references('id')->on(Metrics::getTableName())->onDelete('cascade');
            $table->string('url')->nullable();
            $table->string('anchor_text')->nullable();
            $table->enum(
                'status',
                [
                    'created',
                    'approved',
                    'done'
                ]
            )
                ->default('created');

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
        Schema::dropIfExists(DestinationUrl::getTableName());
    }
}
