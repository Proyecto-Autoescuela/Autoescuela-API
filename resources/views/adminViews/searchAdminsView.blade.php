@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
@endsection

@section('content')

@php( $admins = \App\User::all())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">BUSCAR</div>
                <div class="card-body">
                    <form action="{{ action('UserController@listByName') }}" method="GET" role="search">
                        <div class="input-group mb-3">
                            <input required type="text" class="form-control" placeholder="Introduce el admin" name="name" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" type="button" value="Buscar"/>
                            </div>
                        </div>
                    </form>
                    @if(isset($admin))
                        @foreach($admin as $response)
                        <button>
                            <div class="card mygrid">
                                <div class="card-header">
                                    <h3 class="name">{{$response->id}}. {{$response->name}}</h3>
                                </div>
                                <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p class="text">{{$response->email}}</p>
                                </blockquote>
                                </div>
                            </div>
                        </button>
                        @endforeach
                    @else
                        @foreach($admins as $a)
                        <button>
                            <div class="card mygrid">
                                <div class="card-header">
                                    <h3 class="name">{{$a->id}}. {{$a->name}}</h3>
                                </div>
                                <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p class="text">{{$a->email}}</p>
                                </blockquote>
                                </div>
                            </div>
                        </button>
                        @endforeach
                    @endif
                    <input style="margin-top:1rem" type="button" class="btn btn-light btn-lg btn-block" value="ATRAS" onclick="location.href = '{{ route('admins') }}'"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection