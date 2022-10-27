<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Transformers\RolesResource;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', Role::class);
        $perPage = request()->itemsPerPage ?: 10;
        $query = Role::query();
        $perPage = $perPage == -1 ? $query->count() : $perPage;
        // $query = query->applyFilters();
        $paginator = $query->paginate($perPage);
        return RolesResource::collection($paginator);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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


    public function getPermissions(Request $request)
    {
        $this->authorize('viewAny', Role::class);
        $permissions = Permission::where('guard_name', 'admin')->get();
        return $permissions;
    }
}
