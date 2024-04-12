@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h5 class="m-0">Dashboard</h5>
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

    <div class="box-header">
        <a href="{{ route('admin.balance.deposit') }}" class="btn btn-info">Recarregar</a>
        @if($amount > 0 )
            <a href="{{ route('admin.balance.withdraw.index') }}" class="btn btn-primary">Sacar</a>
            <a href="{{ route('admin.balance.transfer.index') }}" class="btn btn-success">Transferir</a>

            @endif
    </div>

<div class="row">
<div class="col-lg-3 col-6">

<div class="small-box bg-info">
<div class="inner">
<h3>{{ number_format($amount, 2, ',', '') }}</h3>
<p>Saldo</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3>53<sup style="font-size: 20px">%</sup></h3>
<p>Bounce Rate</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3>44</h3>
<p>User Registrations</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-danger">
<div class="inner">
<h3>65</h3>
<p>Unique Visitors</p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
</div>
</div>
@stop