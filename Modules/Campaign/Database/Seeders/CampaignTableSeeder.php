<?php

namespace Modules\Campaign\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\CampaignPlan;
use Faker\Factory;
use Illuminate\Http\Request;
use Modules\Campaign\Http\Controllers\CampaignController;

class CampaignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $campaignPlans = CampaignPlan::all();
        $faker = Factory::create('en_US');
        $controller = new CampaignController();
        for ($counter = 0; $counter < 10; $counter++) {
            foreach ($campaignPlans as $plan) {
                $request = new Request([
                    'name' => $faker->company,
                    'campaign_plan_id' => $plan->id
                ]);
                $controller->store($request);
            }
        }
        // $this->call("OthersTableSeeder");
    }
}
