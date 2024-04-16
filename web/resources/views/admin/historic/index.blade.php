@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h5 class="m-0">Historico</h5>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Dashboard v1</li>
</ol>
</div>
</div>
</div>
@stop

@section('content')
<div class="box">
@include('admin.includes.message')

  <form action="{{ route('admin.historic.search') }}" method="POST" class="form form-inline"> 
    {{ csrf_field() }}
    <input type="text" name="id" placeholder="ID" class="form-control">
    <input type="date" name="fate" placeholder="ID" class="form-control">
    <select  class="form-control">
        <option value=""></option>
        @foreach($types as $key =>  $type)
            <option value="{{ $key }}">{{ $type }}</option>
        @endforeach
    </select>
    <input type="submit" value="Pesquisar" />
  </form>
   <table class="table table-bordered table-hover">
    <header>
        <tr>
            <th>#</th>
            <th>Valor</th>
            <th>Tipo</th>
            <th>Data</th>
            <th>Sender</th>
    </header>
    <tbody>
        @forelse($historics as $historic)
        <tr>
            <td>{{ $historic->id }}</td>
            <td>{{ number_format($historic ->amount, "2", ",", "." ) }}</td>
            <td>{{ $historic->type($historic->type) }}</td>
            <td>{{ $historic->date }}</td>
            <td>
                @if( $historic->user_id_transaction)
                    {{ $historic->userSender->name }}
                @else
                    Outro usuário
                @endif
            </td>
        </tr>
        @empty
        @endforelse
    </tbody>
   </table>

   @if(isset($dataForm))
        {!! $historics->appends($dataForm)->links() !!}
   @else
        {!! $historics->links() !!}
    @endif
</div>
@stop