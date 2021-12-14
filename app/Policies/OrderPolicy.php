<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function author(User $user, Order $order){

        if($order->user_id == $user->id)
            return true;
        else
            return false;

    }

    public function payment(User $user, Order $order){

        if($order->status == 2)
            return false;
        else
            return true;

    }

}
