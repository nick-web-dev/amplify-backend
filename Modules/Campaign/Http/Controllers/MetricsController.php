<?php

namespace Modules\Campaign\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\Metrics;
use Modules\Campaign\Transformers\MetricsResource;

class MetricsController extends Controller
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
            'category_1' => "nullable|max:200",
            'category_2' => "nullable|max:200",
            'keywords' => "nullable",
            'domain_authority' => "nullable",
            'minimum_traffic' => "nullable",
            'content_approval' => "nullable",
            "campaign_id" => [
                "required",
                Rule::exists(Campaign::getTableName(), 'id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ]
        ]);
        $metric = Metrics::create($request->only([
            'category_1',
            'category_2',
            'keywords',
            'domain_authority',
            'minimum_traffic',
            'content_approval',
            'campaign_id',
        ]));
        return new MetricsResource($metric);
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
