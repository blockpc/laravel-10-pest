<?php

declare(strict_types=1);

namespace Packages\Perfil\App\Http\Controllers;

use App\Http\Controllers\Controller;

final class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil::index');
    }

    public function create()
    {
        return view('perfil::index');
    }
}