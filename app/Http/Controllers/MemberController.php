<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Member;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $items = Member::latest()->search($search)->paginate(10);

        return view('members.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'nis' => 'required|string|unique:members,nis',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email ?? $request->nis . '@perpustakaan.sch.id',
            'password' => Hash::make($request->password ?? 'password'),
            'role' => 'siswa',
        ]);

        if (Role::where('name', 'siswa')->exists()) {
            $user->assignRole('siswa');
        }

        $member = Member::create([
            'user_id' => $user->id,
            'nis' => $request->nis,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        ActivityLog::log('create', 'Menambahkan anggota: ' . $member->name, $member);

        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $member->user_id,
            'nis' => 'required|string|unique:members,nis,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:6',
        ]);

        $member->user->update([
            'name' => $request->name,
            'email' => $request->email ?? $request->nis . '@perpustakaan.sch.id',
        ]);

        if ($request->password) {
            $member->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $member->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        ActivityLog::log('update', 'Mengubah anggota: ' . $member->name, $member);

        return redirect()->route('members.index')->with('success', 'Anggota berhasil diperbarui!');
    }

    public function destroy(Member $member)
    {
        ActivityLog::log('delete', 'Menghapus anggota: ' . $member->name, $member);

        $member->user->delete();
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
