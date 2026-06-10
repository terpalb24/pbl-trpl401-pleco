<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.settings', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'min:3', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:accounts,email,' . $user->account_id . ',account_id'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->full_name = $validated['full_name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('account.settings')->with('status', 'account-updated');
    }

    // Admin user management actions
    public function adminIndex(Request $request)
    {
        if (auth()->user()->role !== 'ADMIN') {
            abort(403, 'Unauthorized action.');
        }

        $accounts = Account::orderBy('full_name')->get();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'ADMIN') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'ADMIN') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'min:3', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:accounts,email'],
            'role' => ['required', 'in:ADMIN,OPERATOR'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        Account::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.accounts.index')->with('status', 'account-created');
    }

    public function edit(Account $account)
    {
        if (auth()->user()->role !== 'ADMIN') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.accounts.edit', compact('account'));
    }

    public function updateUser(Request $request, Account $account)
    {
        if (auth()->user()->role !== 'ADMIN') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'min:3', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:accounts,email,' . $account->account_id . ',account_id'],
            'role' => ['required', 'in:ADMIN,OPERATOR'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $account->full_name = $validated['full_name'];
        $account->email = $validated['email'];
        $account->role = $validated['role'];

        if (!empty($validated['password'])) {
            $account->password = Hash::make($validated['password']);
        }

        $account->save();

        return redirect()->route('admin.accounts.index')->with('status', 'account-updated');
    }

    public function bulkDestroy(Request $request)
    {
        if (auth()->user()->role !== 'ADMIN') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'uuid', 'exists:accounts,account_id'],
        ]);

        $ids = $validated['ids'];
        $currentUserId = auth()->user()->account_id;

        // Prevent self-deletion
        $ids = array_diff($ids, [$currentUserId]);

        if (empty($ids)) {
            return redirect()->route('admin.accounts.index')->withErrors(['error' => 'Tidak ada akun valid yang dapat dihapus. (Anda tidak dapat menghapus diri sendiri)']);
        }

        Account::whereIn('account_id', $ids)->delete();

        return redirect()->route('admin.accounts.index')->with('status', 'account-deleted');
    }

    public function destroy(Account $account)
    {
        if (auth()->user()->role !== 'ADMIN') {
            abort(403, 'Unauthorized action.');
        }

        // Prevent self-deletion
        if ($account->account_id === auth()->user()->account_id) {
            return redirect()->route('admin.accounts.index')->withErrors(['error' => 'Anda tidak dapat menghapus akun Anda sendiri.']);
        }

        $account->delete();

        return redirect()->route('admin.accounts.index')->with('status', 'account-deleted');
    }
}
