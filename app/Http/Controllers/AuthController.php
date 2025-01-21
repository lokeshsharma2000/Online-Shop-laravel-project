<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register'); // Render the registration view
    }

    public function home(){
    
        return view('home');
    }
    

    public function showLogin()
    {
        return view('auth.login'); // return the login view
    }
    // Registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone'=>'required|string|max:15',
            'address'=>'required|string|max:255'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone'=>$validated['phone'],
            'address'=>$validated['address']
        ]);

        Auth::login($user);
        
        return redirect()->route('home'); 
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
    
        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ])->withInput(); 
    }
    

    // Logout
    public function logout(Request $request)
    {
        auth()->logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect()->route('login'); 
    }

    public function users(Request $request){
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }
    public function edit(User $user)
{
    return view('users.edit', compact('user'));
}
public function update(Request $request, User $user)
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

    return redirect()->route('users')->with('success', 'User updated successfully.');
}
public function destroy(User $user)
{
   $user->delete();

    return redirect()->route('users')->with('success', 'User deleted successfully.');
}


}


