<?php

namespace App\Http\Controllers;
use App\Models\User;
<<<<<<< HEAD
=======

>>>>>>> 48f9fc284b67a76d0ee92143c1f14946f2fa5a3e
use Illuminate\Http\Request;

class UserController extends Controller
{
public function user(){
    return view('detail.info');
}

public function index()
{
    $products = Product::with('category', 'subcategory')->get();
    // return $products;
    return view('products.index', compact('products'));
}
<<<<<<< HEAD
=======

>>>>>>> 48f9fc284b67a76d0ee92143c1f14946f2fa5a3e
public function showUser(User $user){

    return view('profile.index');
}

public function editUser(User $user){
    return view('profile.edit');
}

public function delete(User $user)
{
   $user->delete();

    return redirect()->route('login')->with('success', 'profile deleted successfully.');
}
public function updateUser(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
         'password' => 'nullable|min:8|confirmed',
          'phone'=>'required|string|max:15',
            'address'=>'required|string|max:255'
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;


    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

<<<<<<< HEAD
    return redirect()->route('user.showuser')->with('success', 'Detail updated successfully.');
=======
    return redirect()->route('showuser')->with('success', 'Detail updated successfully.');
>>>>>>> 48f9fc284b67a76d0ee92143c1f14946f2fa5a3e
}
}
