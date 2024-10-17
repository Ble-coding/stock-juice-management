<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    // public function login(Request $request)
    // {
    //     // Valider les informations d'identification
    //     $credentials = $request->only('email', 'password');

    //     // Essayer d'authentifier en tant que client
    //     if (Auth::guard('customer')->attempt($credentials)) {
    //         $customer = Auth::guard('customer')->user(); // Récupère l'utilisateur client authentifié

    //         // Mettre à jour last_login à la date et l'heure actuelles
    //         $customer->last_login = now();
    //         $customer->save();

    //         // Générer un token d'authentification
    //         $token = $customer->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             'access_token' => $token,
    //             'token_type' => 'Bearer',
    //             'user_type' => 'customer',
    //         ]);
    //     }

    //     // Essayer d'authentifier en tant qu'administrateur
    //     if (Auth::guard('admin')->attempt($credentials)) {
    //         $admin = Auth::guard('admin')->user(); // Récupère l'utilisateur administrateur authentifié

    //         // Générer un token d'authentification pour l'administrateur
    //         $token = $admin->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             'access_token' => $token,
    //             'token_type' => 'Bearer',
    //             'user_type' => 'admin',
    //         ]);
    //     }

    //     return response()->json(['message' => 'Invalid credentials'], 401);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
