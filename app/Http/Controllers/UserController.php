<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kesatuan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8', // Password wajib diisi
            'role' => 'required|in:Admin,Operator,Worker',
        ]);

        User::create([
            'kesatuan' => $request->kesatuan,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash password
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'kesatuan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8', // Password opsional
            'role' => 'required|in:Admin,Operator,Worker',
        ]);

        $data = $request->only('name', 'username', 'role');

        // Jika password diisi, hash sebelum menyimpan
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
