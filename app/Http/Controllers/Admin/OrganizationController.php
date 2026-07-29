<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    /**
     * Daftar Organisasi
     */
    public function index()
    {
        $organizations = Organization::withCount('events')
            ->latest()
            ->paginate(10);

        return view('admin.organizations.index', compact('organizations'));
    }

    /**
     * Form Tambah Organisasi
     */
    public function create()
    {
        return view('admin.organizations.create');
    }

    /**
     * Simpan Organisasi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:organizations,name',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('organizations', 'public');
        }

        Organization::create($validated);

        return redirect()
            ->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil ditambahkan.');
    }

    /**
     * Form Edit Organisasi
     */
    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    /**
     * Update Organisasi
     */
    public function update(Request $request, Organization $organization)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:organizations,name,' . $organization->id,
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {

            if ($organization->logo) {
                Storage::disk('public')->delete($organization->logo);
            }

            $validated['logo'] = $request->file('logo')->store('organizations', 'public');
        }

        $organization->update($validated);

        return redirect()
            ->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil diperbarui.');
    }

    /**
     * Hapus Organisasi
     */
    public function destroy(Organization $organization)
    {
        if ($organization->events()->count() > 0) {
            return back()->with(
                'error',
                'Organisasi tidak bisa dihapus karena masih memiliki event.'
            );
        }

        if ($organization->logo) {
            Storage::disk('public')->delete($organization->logo);
        }

        $organization->delete();

        return redirect()
            ->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil dihapus.');
    }
}