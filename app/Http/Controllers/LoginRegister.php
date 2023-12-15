<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginRegister extends Controller
{

    public function registerpage()
    {
        return view('main.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        /*
        if (Auth::guard('admins')->attempt($credentials)) {
            $admin = Auth::guard('admins')->user();
            $request->session()->put('adminsuccess', true);
            return response()->json([
                "success" => true,
                "role" => "admin"
            ]);
        }*/
        if (Auth::attempt($credentials)) {

            $user = Auth::user(); // Get the authenticated user
            // Store user information in the session
            $request->session()->put('success', true);
            return response()->json([
                "success" => true
            ]);
        }
        return response()->json(["success" => false]);
    }

    public function logout()
    {
        Session::forget('success');
        return redirect('/');
    }

    public function emailExists(Request $request)
    {
        $data = $request->all();
        $email = $data['email'];
        $result = DB::table('users')
            ->where('email', $email)
            ->first();
        if (empty($result)) {
            return response()->json(["success" => false]);
        }
        return response()->json(["success" => true]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        //update memberCount on chapter_table where chapter id = requested chapterid
        $choosen_chapter = $data['chapter'];
        $this->updateMemberCount($choosen_chapter);
        $this->create($data);
        return response()->json(["success" => true]);
    }

    public function updateMemberCount($chapter)
    {
        return DB::table('chapters')
            ->where('name', $chapter)
            ->update(['memberCount' => DB::raw('memberCount + 1')]);
    }

    public function create(array $data)
    {
        return DB::table('users')
            ->insert([
                'uid' => fake()->numberBetween(00000 - 99999),
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'classification' => $data['classification'],
                'chapter' => $data['chapter'],
                'initiation_year' => $data['initiation_year'],
                'batch_name' => $data['batch_name'],
                'baptismal_name' => $data['baptismal_name'],
                'ritualization_status' => $data['ritualization_status'],
                'ritualization_year' => $data['ritualization_year'],
                'ritualization_position' => $data['ritualization_position'],
                'ritualization_position_year' => $data['ritualization_position_year'],
                'alumni_assoc' => $data['alumni_assoc'],
                'assoc_position' => $data['assoc_position'],
                'assoc_position_year' => $data['assoc_position_year'],
                'employment_status' => $data['employment_status'],
                'profession' => $data['profession'],
                'position' => $data['position'],
            ]);
    }
}
