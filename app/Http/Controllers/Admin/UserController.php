<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Daftar User
     */
    public function index()
{
    $users = User::with('organization')
        ->whereIn('role', ['admin', 'superadmin'])
        ->latest()
        ->paginate(10);

    return view('admin.users.index', compact('users'));
}

    /**
     * Form Tambah User
     */
    public function create()
    {
        $organizations = Organization::orderBy('name')->get();

        return view('admin.users.create', compact('organizations'));
    }

    /**
     * Simpan User
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organization_id' => 'nullable|exists:organizations,id',
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:6|confirmed',
            'role'            => 'required|in:superadmin,admin',
        ]);

        // Jika Admin wajib pilih organisasi
        if (
            $validated['role'] === 'admin' &&
            empty($validated['organization_id'])
        ) {
            return back()
                ->withErrors([
                    'organization_id' => 'Admin wajib memilih organisasi.'
                ])
                ->withInput();
        }

        // Super Admin tidak memiliki organisasi
        if ($validated['role'] === 'superadmin') {
            $validated['organization_id'] = null;
        }

        User::create([
            'organization_id' => $validated['organization_id'],
            'name'            => $validated['name'],
            'email'           => $validated['email'],
            'password'        => Hash::make($validated['password']),
            'role'            => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Form Edit User
     */
    public function edit(User $user)
    {
        $organizations = Organization::orderBy('name')->get();

        return view(
            'admin.users.edit',
            compact('user', 'organizations')
        );
    }

    /**
     * Update User
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'organization_id' => 'nullable|exists:organizations,id',
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'password'        => 'nullable|min:6|confirmed',
            'role'            => 'required|in:superadmin,admin',
        ]);

        if (
            $validated['role'] === 'admin' &&
            empty($validated['organization_id'])
        ) {
            return back()
                ->withErrors([
                    'organization_id' => 'Admin wajib memilih organisasi.'
                ])
                ->withInput();
        }

        if ($validated['role'] === 'superadmin') {
            $validated['organization_id'] = null;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->organization_id = $validated['organization_id'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus User
     */
    public function destroy(User $user)
    {
        // Cegah menghapus Super Admin
        if ($user->role === 'superadmin') {
            return back()->with(
                'error',
                'Super Admin tidak dapat dihapus.'
            );
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}