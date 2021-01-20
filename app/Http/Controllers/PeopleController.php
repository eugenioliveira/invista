<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Exibe uma listagem de pessoas físicas cadastradas.
     */
    public function index()
    {
        echo 'Listar pessoas.';
    }

    /**
     * Exibe um formulário de cadastro de pessoa física.
     */
    public function create()
    {
        echo 'Criar pessoa.';
    }
}
