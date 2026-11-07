<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    protected function like(): string
    {
        return DB::connection()->getDriverName() === 'pgsql' ? 'ilike' : 'like';
    }

    protected function likeTerm(string $term): string
    {
        return '%'.addcslashes($term, '\\%_').'%';
    }

    protected function perPage(Request $request, int $default = 10): int
    {
        $value = (int) $request->query('per_page', $default);

        return max(1, min($value > 0 ? $value : $default, 100));
    }

    protected function page(Request $request): int
    {
        return max(1, (int) $request->query('page', 1));
    }
}
