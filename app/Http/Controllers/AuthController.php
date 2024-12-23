<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function signin(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
    
        // Recherche de l'utilisateur par email
        $user = User::where('email', $request->email)->first();
    
        // Vérification des credentials
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        // Génération du token avec Sanctum
        $token = $user->createToken('YourAppName')->plainTextToken;
    
        // Si les informations sont valides, renvoyer un message de succès avec le token
        return response()->json([
            'message' => 'Login successful',
            'user' => $user, // Inclure l'utilisateur dans la réponse pour plus de détails si nécessaire
            'token' => $token // Ajout du token à la réponse
        ], 200); // Code HTTP 200 pour indiquer une réussite
    }
    
    
    public function logout(Request $request)
    {
        // Suppression des tokens de l'utilisateur
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
