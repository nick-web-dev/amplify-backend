<?php

namespace Modules\Campaign\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Http\Controllers\DestinationUrlsController;

class DestinationUrlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Auth::setUser(User::first());
        request()->setUserResolver(function () {
            return User::first();
        });
        $faker = Factory::create('en_US');
        $campaigns = Campaign::all();
        $destinationUrlController = new DestinationUrlsController();
        foreach ($campaigns as $campaign) {
            for ($counter = 0; $counter < rand(1, $campaign->plan->max_number_of_destination_urls); $counter++) {
                $request = new Request([
                    'url' => $faker->url(),
                    'metrics_id' => $campaign->metrics()->inRandomOrder()->first()->id,
                    'status' => 'approved',
                    "campaign_id" => $campaign->id,
                ]);
                $destinationUrlController->store($request);
            }
        }
        // $this->call("OthersTableSeeder");
    }
}
