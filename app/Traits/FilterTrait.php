<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait FilterTrait {
    public function filter(&$query, $request, $filterable)
    {
        $query->where(function($q) use($request, $filterable) {
            $value = "%{$request->get('filter')}%";

            foreach ($filterable as $key => $filterKey) {
                if ($key === 1) {
                    $q->where('company', 'like', $value);
                }

                $q->orWhere($filterKey, 'like', $value);
            }
        });
    }
}