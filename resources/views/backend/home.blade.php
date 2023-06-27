@extends('backend.layout')

@section('content')


<div class="row">
    <div class="col-lg-4 col-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $data['qtdeFotos'] }}</h3>
                <p>Quantidade de fotos</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('fotos') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-4">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $data['qtdeUsers'] }}</h3>
                <p>Quantidade de usuários</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('usuarios') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-4">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $data['qtdeCategorias'] }}</h3>
                <p>Quantidade de categorias</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('categorias') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<h2>DASHBOARD</h2>
@endsection