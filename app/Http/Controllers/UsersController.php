<?php

namespace App\Http\Controllers;

use App\Models\User;

/**
 * Funcionalidade de gerenciamento de usuários.
 *
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }
}
