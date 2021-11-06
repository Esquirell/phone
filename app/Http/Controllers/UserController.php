<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * Поиск пользователя по ID
     */
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

    /*
     * Пополнение баланса телефона не более чем на 100
     */
    public function refillBalance(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|size:13',
            'sum' => 'required|integer|min:1|max:100'
        ]);
        $number = $validated['number'];
        $sum = $validated['sum'];
        $phone = Phone::firstWhere('number', $number);
        $phone->balance += $sum;
        $phone->save();
    }

    /*
     * Создание пользователя (без номера телефона)
     */
    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'birth_date' => 'required|string|size:10',
        ]);
        User::create($validated);
    }

    /*
     * Добавить телефон для пользователя (по ID пользователя)
     */
    public function addPhoneForUser(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'number' => 'required|unique:phones|string|size:13'
        ]);

        $id = $validated['id'];
        $number = $validated['number'];
        $user = User::findOrFail($id);
        $user->phones()->create(['number' => $number]);
    }

    /*
     * Удалить пользователя по ID
     */
    public function deleteUser(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        $id = $validated['id'];
        $user = User::findOrFail($id);
        $user->delete();
    }
}
