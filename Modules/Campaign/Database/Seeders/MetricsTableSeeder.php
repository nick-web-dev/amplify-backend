<?php

namespace Modules\Campaign\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Http\Controllers\MetricsController;

class MetricsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $categories = [
            'sports',
            'economics',
            'politics',
            'health',
            'cars',
            'luxary cars',
            'electric cars',
            'business'
        ];
        $campaigns = Campaign::all();
        $metricsController = new MetricsController();
        foreach ($campaigns as $campaign) {
            for ($counter = 0; $counter < rand(1, $campaign->plan->max_number_of_metrics); $counter++) {
                $request = new Request([
                    "category_1" => Arr::random($categories),
                    "category_2" => Arr::random($categories),
                    "campaign_id" => $campaign->id,
                ]);
                $metricsController->store($request);
            }
        }
        // $this->call("OthersTableSeeder");
    }
}
