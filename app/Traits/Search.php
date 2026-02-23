<?php

namespace App\Traits;

// use Illuminate\Support\Facades\Auth;

trait Search
{

    public function scopeSearch($query, $belongsTo_models = [])
    {

        \View::share('s', request()->s);

        $query->where(function ($query) {
            foreach ($this->searchable as $column) {
                if (request()->has($column)) {
                    $query->where($column, 'LIKE', '%' . request($column) . '%');
                }
            }
            return $query;
        });
        return $query;

        // dd(request('s'));
        \View::share('s', request('s'));
        /* $query->when(request('s'), function ($query) use ($belongsTo_models) {
            $query->where(function ($query) use ($belongsTo_models) {
                foreach (($this->searchable ?? $this->fillable) as $colum) {
                    $query->orWhere($colum, 'LIKE', '%' . request('s') . '%');

                    foreach ($belongsTo_models as $model)
                        $query->orWhereHas($model, function ($query) {
                            $query->search();
                        });
                }
            });
        }); */
    }
}
