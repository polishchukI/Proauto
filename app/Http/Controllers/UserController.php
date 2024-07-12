<?php

namespace App\Http\Controllers;

use App\User;

use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;

use App\Http\Requests\UserRequest;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(User $model)
    {
        $users = User::paginate(25);

        return view('inventory.users.index', compact('users'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        $currencies = Currency::where('active','=','1')->get();

        return view('inventory.users.create', compact('warehouses','currencies'));
    }

    public function store(UserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->get('password'))]);

        User::create($request->all());

        return redirect()->route('users.index')->withStatus('User successfully created.');
    }

    public function edit(User $user)
    {
        $warehouses = Warehouse::all();
        $currencies = Currency::where('active','=','1')->get();
        
        return view('inventory.users.edit', compact('user','warehouses','currencies'));
    }

    public function update(UserRequest $request, User $user)
    {
        $hasPassword = $request->get('password');

        $request->merge(['password' => Hash::make($request->get('password'))]);

        $request->except([$hasPassword ? '' : 'password']);

        $user->update($request->all());

        return redirect()->route('users.index')->withStatus('User successfully updated.');
    }

    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('users.index')->withStatus('User successfully deleted.');
    }
}
