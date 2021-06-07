<?php
/*
 * Projeto: urlshortener
 * Arquivo: ShortlinkController.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 05/06/2021 9:17:16 pm
 * Last Modified: Mon Jun 07 2021
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Slug;
use App\Models\Shortlink;
use Cache;
use Validator;

class ShortlinkApiController extends Controller
{
    private $appUrl;
    private $link;
    private $short;
    private $expire;
    private $slug;
    private $default_expiry_date;
    private $urlRedirect;

    public function __construct(Request $request){
        $this->appUrl = env('APP_URL'). '/api/v1/';
        $this->urlRedirect = env('APP_URL'). '/';

        if($request->expire != NULL){
            $this->expire = $request->expire;
        }elseif($request->expire_adm != NULL) {
            $this->expire = $request->expire_adm;
        }else {
            $this->expire = $request->expire;
        }

        $this->link = $request->link;
        $this->short = $request->shortlink;
        $this->slug = $this->short ? Str::slug($this->short) : Str::random(8);
        $this->addDays = 7;
        $this->default_expiry_date = date('d-m-Y', strtotime(date('d/m/Y').' + '.$this->addDays.' days'));


    }

    public function store(Request $request)
    {
        $rules = [
            'shortlink' => 'unique:shortlinks,shortlink',
            'link' => 'required|url',
            'expire' => 'date_format:d/m/Y',
            'expire_adm' => 'nullable|date_format:Y-m-d'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }

        Shortlink::firstOrCreate([
            'link' => $this->link,
            'shortlink' => $this->slug,
            'expiration_date' => $this->expire ? $this->expire : $this->default_expiry_date
        ]);

        return response()->json([
            'shortlink' => $this->urlRedirect . $this->slug,
        ], 200);
    }


    public function redirect($link){
        if(!\Cache::has('redirect_' . $link)){
            $shortlink = Shortlink::ValidLink()->where('shortlink', $link)->firstOrFail();
            // Cache de 2h
            \Cache::put('redirect_' . $link, $shortlink, 7200);
        }
        $shortlink = \Cache::get('redirect_' . $link);
        return redirect($shortlink->link, 302);
    }

    public function listApi(Request $request){
        $page = $request->query('page');

        if($page){
         $page = $page;
        }else {
            $page = 1;
        }

        if(!\Cache::has('list_shortlinks_' . $page)){
            $records = Shortlink::orderBy('id', 'desc')->paginate(10);
            // Cache de 2 min
            \Cache::put('list_shortlinks_' . $page, $records, 120);
        }
        $records = \Cache::get('list_shortlinks_' . $page);

        return response()->json([$records], 200);
    }
}
