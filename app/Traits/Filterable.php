<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Filterable
{
    public function scopeApplyFilters($query, $request = null)
    {
        if (is_array($request)) {
            $requestArray = $request;
            $request = new Request();
            $request->merge($requestArray);
        }
        $request = $request ?: request();

        $classFilters = $this->filters();
        if ($classFilters) {
            foreach ($classFilters as $filter => $func) {
                $query = $query->when($request->input($filter), function ($query) use ($filter, $classFilters, $request) {
                    return $classFilters[$filter]($query, $request->input($filter));
                });
            }
        }
        $query = $query->applySortable();
        return $query;
    }
    public function scopeApplySortable($query)
    {
        $sorts = request()->input('sortBy', null);
        $descs = request()->input('sortDesc', null);
        if (is_array($sorts)) {
            $classSorts = $this->sorts();
            if ($classSorts) {
                foreach ($classSorts as $sort => $func) {
                    $index = array_search($sort, $sorts);
                    if ($index !== false) {
                        $type = is_array($descs) && array_key_exists($index, $descs) && $descs[$index] == 'true' ? 'DESC' : 'ASC';
                        $query = $classSorts[$sort]($query, $type);
                    }
                }
            }
        }
    }
}
