<?php

namespace Modules\Linquer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Campaign\Entities\DestinationUrl;
use Modules\Linquer\Entities\Task;
use Modules\Linquer\Transformers\TaskResource;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
        $perPage = request()->itemsPerPage ?: 10;

        $query = Task::query();

        $perPage = $perPage == -1 ? $query->count() : $perPage;

        $paginator = $query->paginate($perPage);

        return TaskResource::collection($paginator);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DestinationUrl $url)
    {
        //
        // TO do assign task to linquer
        $task = Task::firstOrCreate([
            'destination_url_id' => $url->id,
            'linquer_id' => null
        ], [
            'status' => "assigned"
        ]);
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
