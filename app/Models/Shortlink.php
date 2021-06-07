<?php
/*
 * Projeto: urlshortener
 * Arquivo: Shortlink.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 05/06/2021 7:13:37 pm
 * Last Modified:  06/06/2021 3:18:08 pm
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shortlink extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'expiration_date'];

    public function scopeValidLink($query)
    {
        return $query->where('expiration_date', '>=', date('Y-m-d'));
    }

}
