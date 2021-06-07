<?php
/*
 * Projeto: urlshortener
 * Arquivo: ShortLinkController.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 05/06/2021 7:08:21 pm
 * Last Modified: Mon Jun 07 2021
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Slug;
use Illuminate\Support\Facades\Http;
use App\Models\Shortlink;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $appUrl;

    public function __construct(){
        $this->appUrl = env('APP_URL'). '/api/v1/lista';
    }

    public function index(Request $request)
    {
       $page = $request->query('page');

       if($page){
        $page = $page;
       }else {
           $page = 1;
       }

        $response = Http::timeout(5)->acceptJson()->get($this->appUrl . '?page=' . $page);
            if($response->successful()) {
                $records = json_decode($response->body(), true)[0];
            }else {
                $records = [];
            }

        return view('backend.shortlink.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shortlink.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addDays = 7;
        $default_expiry_date = date('d-m-Y', strtotime(date('d/m/Y').' + '.$addDays.' days'));

        Shortlink::create([
            'link' => $request->link,
            'shortlink' => $request->shortlink ? Str::slug($request->shortlink) : Str::random(8),
            'expiration_date' => $request->expiration_date ? $request->expiration_date : $default_expiry_date
        ]);
        return redirect()->route('backend.encurtar.index')->with(['message' => 'Shortlink criado com sucesso', 'alert-type'=> 'success']);
    }

}
