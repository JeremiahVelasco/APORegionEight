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
            'studentid' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::guard('admins')->attempt($credentials)) {
            $admin = Auth::guard('admins')->user();
            $request->session()->put('adminsuccess', true);
            return response()->json([
                "success" => true,
                "role" => "admin"
            ]);
        }
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
        $check = $this->create($data);
        return response()->json(["success" => true]);
    }

    public function create(array $data)
    {
        return DB::table('users')
            ->insert([
                'full_name' => $data['fullname'],
                'email' => $data['email'],
                'password' => $data['password'],
                'classification' => $data['classification'],
                'chapter' => $data['chapter'],
                'initiation_year' => $data['initiation-year'],
                'batch_name' => bcrypt($data['batch_name']),
                'baptismal_name' => $data['baptismal-name'],
                'ritualization_status' => $data['ritualization-status'],
                'ritualization_year' => $data['ritualization-year'],
                'ritualization_position' => $data['position-held'],
                'ritualization_position_year' => $data['position-year'],
                'alumni_assoc' => $data['alumi-assoc'],
                'assoc_position' => $data['assoc-position'],
                'assoc_position_year' => $data['assoc-position-year'],
                'employment_status' => $data['employment-status'],
                'profession' => $data['profession'],
                'position' => $data['position'],
            ]);
    }
}
