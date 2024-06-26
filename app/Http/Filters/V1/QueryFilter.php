<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected Builder $builder;
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function filter($arr) : Builder
    {
        foreach ( $arr as $key => $value ) {
            if ( method_exists($this, $key) ) {
                $this->$key($value);
            }
        }
        return $this->builder;
    }

    public function apply(Builder $builder) : Builder
    {
        $this->builder = $builder;

        foreach ( $this->request->all() as $key => $value ) {
            if ( method_exists($this, $key) ) {
                $this->$key($value);
            }
        }

        return $builder;
    }
}
