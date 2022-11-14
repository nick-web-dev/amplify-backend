<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\CampaignClient;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Campaign::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_plan_id')->nullable();
            $table->foreign('campaign_plan_id')->references('id')->on(Campaign::getTableName())->onDelete('set null');
            $table->foreignId('campaign_client_id')->nullable();
            $table->foreign('campaign_client_id')->references('id')->on(CampaignClient::getTableName())->onDelete('set null');
            $table->string('name');
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
        Schema::dropIfExists(Campaign::getTableName());
    }
}
