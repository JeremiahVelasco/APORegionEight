<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function adminusers(Request $request)
    {
        if ($request->ajax()) {
            return User::select("fullname as value", "fullname")
                ->where('fullname', 'LIKE', '%' . $request->get('search') . '%')
                ->get();
        }
        $users = User::simplePaginate(10);

        return view('admin.adminusers', compact('users'));
    }

    public function admindashboard(Request $request)
    {
        $totalUsers = User::count();
        $totalChapters = DB::table('chapters')
            ->count();

        return view('admin.admindashboard', compact('totalUsers', 'totalChapters'));
    }

    public function adminchapters(Request $request)
    {

        $chapters = DB::table('chapters')
            ->get();

        return view('admin.adminchapters', compact('chapters'));
    }
}
