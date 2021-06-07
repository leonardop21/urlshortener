<?php
/*
 * Projeto: urlshortener
 * Arquivo: index.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 05/06/2021 12:42:51 pm
 * Last Modified: Mon Jun 07 2021
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

?>
@extends('layouts.backend')
@section('title','Lista de Urls')
@section('subtitle','Lista de Urls')

@section('content')
<div class="col-12">
    <a href="{{route('backend.encurtar.create')}}" class="btn btn-success m-2 mb-4">Adicionar</a>
        <h6 class="ml-2">Pode demorar até dois minutos para a lista ser atualizada</h6>
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>Link</th>
                <th>Shortlink</th>
                <th>Data de expiração</th>
            </tr>
            </thead>
            <tbody>
            @forelse($records['data'] as $record)
                <tr>
                    <td>{{$record['link']}}</td>
                    <td>
                        <a href="{{env('app_url')}}/{{$record['shortlink']}}" target="_blank">
                            {{$record['shortlink']}}
                        </a>
                    </td>
                    <td>{{\Carbon\Carbon::parse($record['expiration_date'])->format('d/m/Y')}}</td>

                </tr>
            @empty
                <tr>
                    <td>
                        <h5>Não foi possível listar os dados no momento, por favor, tente novamente mais tarde ou adicione seu primeiro short link</h5>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
<!-- /.card -->
</div>
@if(count($records) > 1)
    @include('backend.includes.pagination', ['paginator' => $records])
@endif
@endsection
