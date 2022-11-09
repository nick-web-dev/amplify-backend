<?php

namespace Modules\Campaign\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\CampaignPlan;
use Modules\Campaign\Transformers\CampaignResource;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'campaign_plan_id' => [
                "required",
                Rule::exists(CampaignPlan::getTableName(), 'id')->whereNull('deleted_at')
            ],
            'name' => "required"
        ]);
        $campaign = Campaign::create($request->only(['campaign_plan_id', 'name']));
        return new CampaignResource($campaign);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
