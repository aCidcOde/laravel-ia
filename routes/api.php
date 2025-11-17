<?php

use App\Models\Certidao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/certidoes', function (Request $request) {
    $data = $request->validate([
        'user_id' => ['required', 'integer', 'exists:users,id'],
        'nome' => ['required', 'string', 'max:255'],
        'data_inclusao' => ['nullable', 'date'],
        'descricao' => ['nullable', 'string'],
        'palavras_chave' => ['nullable', 'string'],
        'arquivo_url' => ['nullable', 'url'],
    ]);

    /** @var \App\Models\User $user */
    $user = User::findOrFail($data['user_id']);

    $certidao = $user->certidoes()->create([
        'nome' => $data['nome'],
        'data_inclusao' => $data['data_inclusao'] ?? now(),
        'descricao' => $data['descricao'] ?? null,
        'palavras_chave' => $data['palavras_chave'] ?? null,
        'arquivo_url' => $data['arquivo_url'] ?? null,
    ]);

    return response()->json([
        'message' => 'Certidão criada com sucesso.',
        'data' => $certidao->toArray(),
    ], 201);
});
