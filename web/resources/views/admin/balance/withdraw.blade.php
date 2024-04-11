@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Saque</h1>
@stop

@section('content')
  <div class="box">
    @include('admin.includes.message')
    <form action="{{ route('admin.balance.withdraw.store') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label>Valor de saque</label>
            <input type="text" name="value" class="form-control" placeholder="Digite o saque" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-info" value="Sacar" />
        </div>
    </form>
  </div>
@stop