
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Confirmar Usuário</h1>
@stop

@section('content')
  <div class="box">
    @include('admin.includes.message')
    <h5>Saldo: R$ {{ number_format($balance->amount, '2', ',', '.') }}</h5>
    <p>Nome: {{ $sender->name }}</p>
    <p>E-mail: {{ $sender->email }}</p>

    <form action="{{ route('admin.balance.transfer.store') }}" method="post">
        {!! csrf_field() !!}
        <input type="hidden"  name="sender_id" value="{{ $sender->id }}" />
        <div class="form-group">
            <label>Valor</label>
            <input type="text" name="value" class="form-control" placeholder="Digite o valor" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-info" value="Sacar" />
        </div>
    </form>
  </div>
@stop