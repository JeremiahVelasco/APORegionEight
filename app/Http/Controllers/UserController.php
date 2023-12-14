<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function directory(Request $request)
    {
        if ($request->ajax()) {
            return User::select("fullname as value", "fullname")
                ->where('fullname', 'LIKE', '%' . $request->get('search') . '%')
                ->get();
        }
        $users = User::simplePaginate(10);

        return view('main.directory', compact('users'));
    }
}
