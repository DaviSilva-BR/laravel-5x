
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Transferência</h1>
@stop

@section('content')
  <div class="box">
    @include('admin.includes.message')
    <form action="{{ route('admin.balance.transfer.search') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label>Informe o e-mail</label>
            <input type="email" name="sender" class="form-control" placeholder="Digite o e-mail" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-info" value="Sacar" />
        </div>
    </form>
  </div>
@stop