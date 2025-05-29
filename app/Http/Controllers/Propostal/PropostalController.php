<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Propostal;

use App\Http\Controllers\Controller;

class PropostalController extends Controller
{
    public function index()
    {
        return view('propostal.index');
    }

    public function create()
    {
        return view('propostal.form');
    }
}
