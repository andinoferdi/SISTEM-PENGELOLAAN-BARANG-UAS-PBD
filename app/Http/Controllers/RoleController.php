<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function index()
    {
        $roles = DB::table('role')->get();
        return view('dashboard.role.index', compact('roles'));
    }

    public function create()
    {
        return view('dashboard.role.create');
    }

    public function edit($id)
    {
        $role = DB::table('role')->where('role_id', $id)->first();

        if (!$role) {
            abort(404, 'Role tidak ditemukan.');
        }

        return view('dashboard.role.edit', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
        ]);

        try {
            DB::select('CALL InsertRole(?)', [
                $request->input('nama_role'),
            ]);

            return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('role.index')->with('error', 'Gagal menambahkan role: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
        ]);

        try {
            DB::table('role')
                ->where('role_id', $id)
                ->update([
                    'nama_role' => $request->input('nama_role'),
                ]);

            return redirect()->route('role.index')->with('success', 'Role berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('role.index')->with('error', 'Gagal memperbarui role: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('role')->where('role_id', $id)->delete();

            return redirect()->route('role.index')->with('success', 'Role berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('role.index')->with('error', 'Gagal menghapus role: ' . $e->getMessage());
        }
    }
}
