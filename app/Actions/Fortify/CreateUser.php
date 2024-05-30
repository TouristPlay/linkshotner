<?php

namespace App\Actions\Fortify;

use App\Models\User as User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers as CreateUserContract;

class CreateUser implements CreateUserContract
{
    use PasswordValidationRules;

    /**
     * @throws ValidationException
     */
    public function create(array $data)
    {
        $validate = Validator::make($data, [
            'name' => ['required', 'max:255', 'string'],
            'username' => ['required', 'max:255', 'string'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
        ]);
    }
}

