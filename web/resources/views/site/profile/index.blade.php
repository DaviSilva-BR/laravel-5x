@extends('site.template.app')

@section('title', 'Meu Perfil')
@section('content')

<h1>Perfil</h1>

@include('admin.includes.message')
<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
{!! csrf_field() !!}
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" value="{{ auth()->user()->name }}" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" value="{{ auth()->user()->email }}" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label>Senha:</label>
        <input type="password"  autocomplete="off"  name="password" class="form-control">
    </div>
    <div class="form-group">
        @if(auth()->user()->image != null)
            <img src="{{ url('storage/users/'. auth()->user()->image) }}" width="50" alt="{{ auth()->user()->name }}" />
        @endif
        <label>Imagem:</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit"  class="btn btn-primary mt-2" value="SALVAR">
    </div>
</form>
@endsection