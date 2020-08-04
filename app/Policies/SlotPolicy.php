<?php

namespace App\Policies;

use App\Models\Slot;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class SlotPolicy
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

    public function create(Slot $slot)
    {
        if(Auth::guard('admin')->check())
            return true;
        else
            return false;
    }

    public function update(Slot $slot)
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
