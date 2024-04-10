@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Deposito</h1>
@stop

@section('content')
  <div class="box">
    <form action="{{ route('balance.deposit.store') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label>Valor de recarga</label>
            <input type="text" name="value" class="form-control" placeholder="Digite a recarga" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-info" value="Salvar Recarga" />
        </div>
    </form>
  </div>
@stop