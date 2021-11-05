<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function findUser(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer'
        ]);

        $id = $validated['id'];
        $user = User::with('phones')->findOrFail($id);
        $user_name = $user->name;
        $user_birth_date = $user->birth_date;
        $phones = [];

        foreach ($user->phones as $phone) {
            $phones[] = $phone->number;
        }
        dd($user_name, $user_birth_date, $phones);
    }

    public function refillBalance(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|size:13',
            'sum' => 'required|integer|min:1|max:100'
        ]);

        $number = $validated['number'];
        $sum = $validated['sum'];
        if ($sum > 0 && $sum <= 100) {
            $phone = Phone::firstWhere('number', $number);
            $phone->balance += $sum;
            $phone->save();
        }
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'birth_date' => 'required|string|size:10',
        ]);
        User::create($validated);
    }
}
