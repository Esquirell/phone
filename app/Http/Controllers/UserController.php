<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function findUser($id)
    {
        $user = User::with('phones')->findOrFail($id);
        $user_name = $user->name;
        $user_birth_date = $user->birth_date;
        $phones = [];

        foreach ($user->phones as $phone) {
            $phones[] = $phone->number;
        }

        dd($user_name, $user_birth_date, $phones);
    }

    public function refillBalance($number, $sum)
    {
        if ($sum > 0 && $sum <= 100) {
            $phone = Phone::firstWhere('number', $number);
            $phone->balance += $sum;
            $phone->save();
        }
    }
}
