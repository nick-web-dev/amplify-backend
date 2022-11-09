<?php

namespace Modules\Campaign\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Campaign\Http\Controllers\CampaignPlanController;

class CampaignPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $plans = [
            [
                'max_number_of_destination_urls' => 1,
                'max_number_of_metrics' => 1,
            ],
            [
                'max_number_of_destination_urls' => 5,
                'max_number_of_metrics' => 1,
            ]
        ];
        $campaignPlanController = new CampaignPlanController();
        foreach ($plans as $plan) {
            $request = new Request($plan);
            $campaignPlanController->store($request);
        }
        // $this->call("OthersTableSeeder");
    }
}
