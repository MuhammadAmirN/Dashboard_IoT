<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserManagementController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show user management page (monitoring + role assignment)
     */
    public function index()
    {
        $user = auth()->user();
        
        // Check authorization
        if (!in_array($user->role, ['super_admin', 'admin'])) {
            abort(403, 'Unauthorized');
        }

        $users = User::orderBy('created_at', 'desc')->paginate(15);
        $stats = [
            'total_users' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'super_admins' => User::where('role', 'super_admin')->count(),
            'regular_users' => User::where('role', 'user')->count(),
        ];

        return view('users.management', compact('users', 'stats'));
    }

    /**
     * Show role assignment page (Super Admin only)
     */
    public function assignRole($userId)
    {
        $this->authorize('manageRoles', auth()->user());
        
        $user = User::findOrFail($userId);
        $roles = ['user', 'admin', 'super_admin'];
        
        return view('users.assign-role', compact('user', 'roles'));
    }

    /**
     * Update user role (Super Admin only)
     */
    public function updateRole(Request $request, $userId)
    {
        $this->authorize('manageRoles', auth()->user());
        
        $request->validate([
            'role' => 'required|in:user,admin,super_admin',
        ]);

        $user = User::findOrFail($userId);
        
        // Prevent deleting yourself as super admin
        if (auth()->id() === $userId && $request->role !== 'super_admin') {
            return back()->withErrors('Anda tidak bisa mengubah role diri sendiri dari super admin');
        }

        $user->update(['role' => $request->role]);

        return redirect()->route('user-management.index')
            ->with('success', "Role user '{$user->name}' berhasil diubah menjadi {$request->role}");
    }

    /**
     * Delete user (Super Admin only)
     */
    public function deleteUser($userId)
    {
        $this->authorize('manageRoles', auth()->user());
        
        $user = User::findOrFail($userId);
        
        if (auth()->id() === $userId) {
            return back()->withErrors('Anda tidak bisa menghapus akun sendiri');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('user-management.index')
            ->with('success', "User '{$name}' berhasil dihapus");
    }
}
