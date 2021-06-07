<?php
/*
 * Projeto: urlshortener
 * Arquivo: create.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */
?>
@extends('layouts.backend')
@section('title','Encutar Url')
@section('subtitle','Encurtar Url')
@section('content')
<div class="col-12">
  <div class="card card-primary">
    <form method="post" action="{{route('api.store.post')}}">
      @csrf
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label for="link">URL *</label>
              <input type="url" class="form-control" id="link" name="link" placeholder="Ex:" value="{{old('link')}}" required>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="shortlink">Escolher link curto</label>
              <input type="text" class="form-control" id="shortlink" name="shortlink" placeholder="Ex: minha noticia" value="{{old('shortlink')}}" maxlength="200">
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="expire">Data de expiração</label>
              <input type="date" name="expire_adm"  class="form-control">
            </div>
          </div>
        </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-success">Encurtar</button>
      </div>
    </form>
    <small>Você pode escolher o link curto ou deixar em branco para ser gerado automaticamente. O tempo padrão para expiração da URL é de 7 dias</small>
  </div>
</div>
@endsection
