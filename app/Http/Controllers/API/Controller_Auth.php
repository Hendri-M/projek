<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataNIDN;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controller_Auth extends Controller
{
    public function register(Request $request)
    {
        // Register
        // Validasi Inputan
        $validasi = validator($request->all(), [
            'nidn_nik' => 'required',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'level' => 'required'
        ]);

        // Cek Data
        try {
            if (DataNIDN::where('NIDN_NIK', $request['nidn_nik'])->first()) {

                $data = $request->all();
                $data['password'] = bcrypt($data['password']);
                $user = User::create($data);

                // Membuat Token
                // $data['token'] = $user->createToken('auth_token')->plainTextToken;
                $data['name'] = $user->name;

                // Tampilkan JSON pada Postman
                return response()->json([
                    'status' => true,
                    'pesan' => 'Registrasi Berhasil',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'pesan' => 'Terjadi Kesalahan',
                    'data' => $validasi->errors()
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Error',
                'error' => $e->getMessage()
            ], 401);
        }
    }

    // Login
    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $auth = Auth::user();
                $token = $auth->createToken('auth_token')->plainTextToken;
                $auth->token = $token;

                return response()->json([
                    'status' => true,
                    'pesan' => 'Berhasil Login',
                    'data' => $auth
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'pesan' => 'Cek Inputan Anda atau Data Tidak Terdaftar',
                    'data' => null
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Login Error',
                'error' => $e->getMessage()
            ]);
        }
    }

    // Log Out
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'pesan' => 'Logout Berhasil'
        ]);
    }
}
