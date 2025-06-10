<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AssetsController extends Controller
{
    public function index(): View
    {
        return view('assets.index');
    }

    public function find(): View
    {
        return view('assets.asset');
    }

    public function edit(): View
    {
        return view('assets.edit');
    }
}
