<?php
/*
 * Projeto: urlshortener
 * Arquivo: HomeController.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 05/06/2021 12:42:46 pm
 * Last Modified: Mon Jun 07 2021
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shortlink;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.index.index');
    }

    public function redirect($link){
        if(!\Cache::has('redirect_' . $link)){
            $shortlink = Shortlink::ValidLink()->where('shortlink', $link)->firstOrFail();
            // Cache de 2h
            \Cache::put('redirect_' . $link, $shortlink, 7200);
        }
        $shortlink = \Cache::get('redirect_' . $link);
        return redirect()->away($shortlink->link);
    }
}
