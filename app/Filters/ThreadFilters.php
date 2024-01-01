<?php

namespace App\Filters;

use App\Models\User;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular', 'unanswered'];

    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    protected function popular()
    {
        // note the re-order to overide the default 'latest' on the get
        return $this->builder->reOrder('replies_count', 'desc');
    }

    protected function unanswered()
    {
        // note the re-order to overide the default 'latest' on the get
        return $this->builder->where('replies_count', 0);
    }
}
