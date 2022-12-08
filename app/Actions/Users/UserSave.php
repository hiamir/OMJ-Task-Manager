<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class UserSave
{
    use AsAction;
    use withAttributes;


    /**
     * @throws ValidationException
     */
    public function handle(User $user):array
    {
      $user= UserSanitizeData::run($user);
        $data = $this->set('user', $user)->fill($user->toArray());
        Validator::make(
            $data->attributes,
            UserValidation::make()->rules($this->user->id),
            UserValidation::make()->messages(),
        )->validate();
        try {
            $success = DB::transaction(function () use ($user) {
                $user->save();
                return [true, $user];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }



}
