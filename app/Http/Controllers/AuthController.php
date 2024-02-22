<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, Validator};

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email é obrigatório',
            'password.required' => 'Senha é obrigatória',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }

        $login = $request->all();

        if (!auth()->attempt($login)) {
            return $this->error('As credenciais fornecidas não correspondem aos nossos registros.', 401);
        }

        $user = User::where('email', $login['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user'         => $user,
            'access_token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
            'name'     => 'required',
            'cpf'      => 'required',
            'phone'    => 'required',
            'type'     => 'required',
        ], [
            'email.required'    => 'Email é obrigatório',
            'password.required' => 'Senha é obrigatória',
            'name.required'     => 'Nome é obrigatório',
            'cpf.required'      => 'CPF é obrigatório',
            'phone.required'    => 'Telefone é obrigatório',
            'type.required'     => 'Tipo é obrigatório',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }

        // Create a new user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'cpf'      => $request->cpf,
            'phone'    => $request->phone,
            'type'     => $request->type,
        ]);

        if (!$user) {
            return $this->error('Erro ao criar usuário', 500);
        }

        return $this->success($user, 'Usuário criado com sucesso', 201);
    }
}
