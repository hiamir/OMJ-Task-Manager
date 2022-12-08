<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class UserDelete
{
    use AsAction;
    use withAttributes;


    public function handle(User $user):array
    {
        try {
            $success = DB::transaction(function () use ($user) {
                $user->delete();
                return [true, $user];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }


}
