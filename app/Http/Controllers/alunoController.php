<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno; 
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers;

class AlunoController extends Controller
{
    public function index()
    {
        $dadosAlunos = Aluno::all();
        $contador = $dadosAlunos->count();

        return response()->json(['message' => 'Alunos encontrados: ' . $contador, 'data' => $dadosAlunos], 200);
    }

    public function store(Request $request)
    {
        $dadosAlunos = $request->all();

        $valida = Validator::make($dadosAlunos, [
            'nomeAluno' => 'required',
            'classeAluno' => 'required',
        ]);

        if ($valida->fails()) {
            return response()->json(['error' => 'Dados inválidos', 'details' => $valida->errors()], 422);
        }

        $alunoBanco = Aluno::create($dadosAlunos);

        if ($alunoBanco) {
            return response()->json(['message' => 'Aluno cadastrado com sucesso'], 201);
        } else {
            return response()->json(['error' => 'Falha ao cadastrar aluno'], 500);
        }
    }

    public function show(string $id)
    {
        $alunoBanco = Aluno::find($id);

        if ($alunoBanco) {
            return response()->json(['message' => 'Aluno encontrado', 'data' => $alunoBanco], 200);
        } else {
            return response()->json(['error' => 'Aluno não encontrado'], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $alunoDados = $request->all();

        $valida = Validator::make($alunoDados, [
            'nomeAluno' => 'required',
            'classeAluno' => 'required'
        ]);

        if ($valida->fails()) {
            return response()->json(['error' => 'Dados inválidos', 'details' => $valida->errors()], 422);
        }

        $alunoBanco = Aluno::find($id);

        if ($alunoBanco) {
            $alunoBanco->update($alunoDados);
            return response()->json(['message' => 'Dados do aluno atualizados com sucesso'], 200);
        } else {
            return response()->json(['error' => 'Aluno não encontrado'], 404);
        }
    }

    public function destroy(string $id)
    {
        $alunoBanco = Aluno::find($id);

        if ($alunoBanco) {
            $alunoBanco->delete();
            return response()->json(['message' => 'Aluno deletado com sucesso'], 200);
        } else {
            return response()->json(['error' => 'Aluno não encontrado'], 404);
        }
    }
}

