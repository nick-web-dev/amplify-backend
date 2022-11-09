<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Campaign\Entities\CampaignPlan;

class CreateCampaignPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CampaignPlan::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->integer("max_number_of_destination_urls")
                ->nullable()
                ->default(10)
                ->comment('Max number of det urls client can insert in a campaign has this plan');
            $table->integer('max_number_of_metrics')
                ->nullable()
                ->default(1)
                ->comment("Max number of metrics client can have inside a campaign has this plan");
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
        Schema::dropIfExists(CampaignPlan::getTableName());
    }
}
