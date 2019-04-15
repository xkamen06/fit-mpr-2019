<?php

namespace App\Http\Controllers;

use App\RoleEnum;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Index of users
     * @return View
     */
    public function index(): View
    {
        $users = User::where('id', '!=', Auth::id())->orderBy('id', 'desc')->paginate(15);
        return view('user.index', compact('users'));
    }

    /**
     * User detail
     * @param int $userId
     * @return View
     */
    public function detail(int $userId): View
    {
        $user = User::find($userId);
        return view('user.detail', compact('user'));
    }

    /**
     * Edit user
     * @param int $userId
     * @return View
     */
    public function edit(int $userId): View
    {
        $roles = RoleEnum::all();
        $user = User::find($userId);
        return view('user.edit', compact( 'user', 'roles'));
    }

    /**
     * Update user
     * @param int $userId
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $userId, Request $request): RedirectResponse
    {
        $user = User::find($userId);
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        if ($request->role) {
            $user->id_role_enum = $request->role;
        }
        $user->save();
        return redirect()->route('user.detail', ['userId' => $user->id]);
    }

    /**
     * Create user
     * @return View
     */
    public function create() : View
    {
        $roles = RoleEnum::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store user
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->id_role_enum = $request->role;
        $user->save();
        return redirect()->route('user.detail', ['userId' => $user->id]);
    }
}