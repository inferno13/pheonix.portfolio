<?php

namespace App\Support;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Paginator {
  public static function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
