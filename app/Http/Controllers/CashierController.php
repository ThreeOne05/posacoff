<?php

// app/Http/Controllers/CashierController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CashierController extends Controller
{
    public function index()
    {
        $cashiers = User::where('role', 'cashier')->get();
        return view('cashiers.index', compact('cashiers'));
    }

    public function create()
    {
        return view('cashiers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // gunakan konfirmasi password
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'cashier',
        ]);

        return redirect()->route('cashiers.index')->with('success', 'Kasir berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $cashier = User::where('role', 'cashier')->findOrFail($id);
        return view('cashiers.edit', compact('cashier'));
    }

    public function update(Request $request, $id)
    {
        $cashier = User::where('role', 'cashier')->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $cashier->update($updateData);

        return redirect()->route('cashiers.index')->with('success', 'Kasir berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cashier = User::where('role', 'cashier')->findOrFail($id);
        $cashier->delete();

        return redirect()->route('cashiers.index')->with('success', 'Kasir berhasil dihapus.');
    }
}
