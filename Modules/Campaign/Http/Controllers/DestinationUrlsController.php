<?php

namespace Modules\Campaign\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\DestinationUrl;
use Modules\Campaign\Entities\Metrics;
use Modules\Campaign\Transformers\DestinationUrlResource;

class DestinationUrlsController extends Controller
{
    use AuthorizesRequests;
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

            'campaign_id' => [
                "required",
                Rule::exists(Campaign::getTableName(), 'id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ],
            'metrics_id' => [
                "nullable",
                Rule::exists(Metrics::getTableName(), 'id')->where(function ($query) use ($request) {
                    return $query->whereNull('deleted_at')->where('campaign_id', $request->campaign_id);
                })
            ],
            'url' => "required|url",
            "anchor_text" => "nullable",
            "status" => "nullable|in:created,approved,done"
        ]);
        $campaign = Campaign::find($request->campaign_id);

        $this->authorize('create', [DestinationUrl::class, $campaign]);

        if (!$request->metrics_id) {
            $metrictController = new MetricsController();
            $metricsRequest = new Request($request->input('metrics', []));
            $metrics = $metrictController->store($metricsRequest);
            $request->merge(['metrics_id', $metrics->id]);
        }
        $destinationUrl = DestinationUrl::create($request->only([
            'url',
            'campaign_id',
            'metrics_id',
            'url',
            'anchor_text',
            'status',
        ]));
        return new DestinationUrlResource($destinationUrl);
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
