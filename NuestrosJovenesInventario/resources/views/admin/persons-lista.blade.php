@extends('layouts.private')

@section('content')
<div class="bar-options">
    <a class="w3-button w3-blue w3-block w3-round" href="person-form">
        <i class="fas fa-plus-circle"></i>
        Nueva Persona
    </a>
</div>
<h1>Administración de personas</h1>
@if(Session::has('mensaje'))
<div class="alert alert-info">{{session('mensaje')}}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger">{{session('error')}}</div>
@endif
<form method="POST" action="{{route('buscar-persona')}}">
    {{csrf_field()}}
    <div class="w3-row">
        <div class="w3-col l2 m2 s12">
            <label for="txt-persona">Nombre Persona</label>
            <input name="txt-persona" type="text" class="w3-input w3-border">
        </div>
        <div class="w3-col l1 m1 s12">
            <br />
            <button class="w3-button"> <i class="fas fa-search fa-2x"></i></button>
        </div>
    </div>
</form>
<br />

@if ($personas->isEmpty())
<div class="w3-panel w3-pale-blue w3-round">
    <br />
    <p>No existen registros</p>
</div>
@endif


<!-- encabezado -->
@if ($personas->isNotEmpty())
<div layout="block" class="w3-row row-header">
    <div class="w3-col s10 m10 l10">
        <div class="w3-row w3-hide-small">
            <div class="w3-col l3 m3">Nombre</div>
            <div class="w3-col l3 m3">Apellido</div>
            <div class="w3-col l3 m3">Número Identificación</div>
            <div class="w3-col l3 m3">Estado</div>

        </div>

    </div>

    <div class="w3-col m2 l2 w3-hide-small col-acciones">Acciones</div>
</div>
@endif
<br />

<!-- Cuerpo -->
@foreach ($personas as $p)
<div class="w3-row bg-{{ $loop->index %  2}}">
    <div class="w3-col s10 m10 l10 col-datos">
        <div class="w3-row">
            <div>
                <div class="w3-col s6 w3-hide-medium w3-hide-large">Nombre</div>
                <div class="w3-col l3 m3 s6">{{$p->nombre}}</div>
            </div>
            <div>
                <div class="w3-col s6 w3-hide-medium w3-hide-large">Apellido</div>
                <div class="w3-col l3 m3 s6"> {{$p->apellido}}</div>
            </div>
            <div>
                <div class="w3-col s6 w3-hide-medium w3-hide-large">Número de documento</div>
                <div class="w3-col l3 m3 s6">{{$p->numero_identificacion}}</div>
            </div>

            <div>
                <div class="w3-col s6 w3-hide-medium w3-hide-large">Estado</div>
                <div class="w3-col l3 m3 s6">{{$p->estado}}</div>
            </div>
        </div>
    </div>

    <div class="w3-col s2 m2 l2 col-acciones">
        <a href="{{url('editar/'.$p->id)}}" class="w3-button"><i class="fas fa-lg fa-edit"></i></a>
       
        @if($p->estado=='A')
        <form style="display: inline;" action="{{route('inactivarPersona',$p->id)}}" method="POST">
            {{csrf_field()}}
            <button class="w3-button" title="Inactivar"><i class="fas fa-lg fa-trash w3-text-red"></i></button>
        </form>
        @endif
        @if($p->estado=='I')
        <form style="display: inline;" action="{{route('activarPersona',$p->id)}}" method="POST">
            {{csrf_field()}}
            <button class="w3-button" title="Activar"><i class="fas fa-lg fa-check w3-text-green"></i></button>
        </form>
        @endif
    </div>
</div>
@endforeach
{{$personas->links()}}

@endsection