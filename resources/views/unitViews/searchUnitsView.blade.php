@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/searchUnit.css') }}" rel="stylesheet">
@endsection

@section('content')

@php( $units = \App\Unit::all())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">BUSCAR</div>
                <div class="card-body">
                    <form action="{{ action('UnitController@listByID') }}" method="GET" role="search">
                        <div class="input-group mb-3">
                            <input required type="text" class="form-control" placeholder="Introduce número del tema que quieres encontrar" name="id" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" type="button" value="Buscar"/>
                            </div>
                        </div>
                    </form>
                    <input style="margin-bottom: 1rem" type="button" class="btn btn-light btn-lg btn-block" value="ATRAS" onclick="location.href = '{{ route('units') }}'"/>
                    @if(isset($unit))
                        @foreach($unit as $response)
                        <button>
                            <div class="card mygrid">
                                <div class="card-header">
                                    <h3 class="name">Tema {{$response->id}}: {{$response->name}}<img style="max-width: 70px" src="{{ URL::to('../') }}/storage/app/public/{{$response->unit_url}}"/></h3>
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p class="text"><pre>{{$response->content_unit}}</pre></p>
                                    </blockquote>
                                </div>
                            </div>
                        </button>
                        @endforeach
                    @else
                        @foreach($units as $u)
                        <button style="margin-bottom: 1rem">
                            <div class="card mygrid" style="max-width: 42rem">
                                <div class="card-header">
                                <h3 class="name">Tema {{$u->id}}: {{$u->name}}<img style="max-width: 70px" src="{{ URL::to('../') }}/storage/app/public/{{$u->unit_url}}"/></h3>
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p class="text"><pre>{{$u->content_unit}}</pre></p>
                                    </blockquote>
                                </div>
                            </div>
                        </button>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection