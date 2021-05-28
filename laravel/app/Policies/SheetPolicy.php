<?php

namespace App\Policies;

use App\Sheet;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SheetPolicy
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

    public function update(User $user, Sheet $sheet)
    {
        return $user->id === $sheet->user_id;
    }

    public function done(User $user, Sheet $sheet)
    {
        return $user->id === $sheet->user_id;
    }

    public function destroy(User $user, Sheet $sheet)
    {
        return $user->id === $sheet->user_id;
    }

}
