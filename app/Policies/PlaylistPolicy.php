<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Playlist;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PlaylistPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create()
    {
        if(Auth::guard('admin')->check())
            return true;
        else
            return false;
    }

    public function update()
    {
        if(Auth::guard('admin')->check())
            return true;
        else
            return false;
    }

    public function delete()
    {
        if(Auth::guard('admin')->check())
            return true;
        else
            return false;
    }
}
