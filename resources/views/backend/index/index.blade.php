@extends('layouts.backend')
@section('title','Home')
@section('content')


<h3>Bem-vindo, {{\Auth::user()->name}}</h3>


@endsection
