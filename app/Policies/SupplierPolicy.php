<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Supplier;

class SupplierPolicy
{
    public function accessSupplierData(User $user, Supplier $supplier)
    {
        return $user->id === $supplier->user_id;
    }
}
