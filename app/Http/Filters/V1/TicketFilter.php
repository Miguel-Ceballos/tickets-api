<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;

class TicketFilter extends QueryFilter
{

    public function createdAt($value)
    {
        $dates = explode(',', $value);

        if ( count($dates) > 1 ) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function include($value) : Builder
    {
        return $this->builder->with($value);
    }

    public function status($value) : Builder
    {
        return $this->builder->whereIn('status', explode(',', $value));
    }

    public function title($value) : Builder
    {
        $likeString = str_replace('*', '%', $value);
        return $this->builder->where('title', 'like', $likeString);
    }

    public function updatedAt($value) : Builder
    {
        $dates = explode(',', $value);

        if ( count($dates) > 1 ) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

}
