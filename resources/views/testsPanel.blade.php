@extends('layouts.app')


@section('header')
<ul class="nav justify-content-center">
    <div class="nav " id="nav-tab" role="tablist">
        <a class="nav-link" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="false" href="#" onclick="location.href = '{{ route('users') }}'">USUARIOS</a>
        <a class="nav-link" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="false" href="#" onclick="location.href = '{{ route('units') }}'">TEMAS</a>
        <a class="nav-link active" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="true" href="#"  onclick="location.href = '{{ route('tests') }}'">TESTS</a>
    </div>
</ul>
@endsection

@section('styles')
    <link href="{{ asset('css/tests.css') }}" rel="stylesheet">
@endsection


@php( $units = \App\Unit::all())
@php( $ques = \App\Question::all())

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">TESTS</div>
                <div class="card-body">
                    <form action="{{ action('UnitController@listByName') }}" method="GET" role="search">
                        <div class="input-group mb-3">
                            <input required type="text" class="form-control" placeholder="Introduce el nombre del tema" name="name" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" type="button" value="Buscar"/>
                                <input type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addModal" value="Añadir"/>
                            </div>
                        </div>
                    </form>
                    @if(isset($que))
                        @foreach($que as $response)
                        @endforeach
                    @else
                        @foreach($units as $u)
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header myGrid" id="headingOne">
                                    <img width="80%" src="{{ URL::to('../') }}/storage/app/public/{{$u->img}}"/>
                                    <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h5 class="mb-0" style="float: left">Tema {{$u->id}}: {{$u->name}}</h5>
                                    </button>
                                    <button class="open-deleteDialog close" data-name="{{$u->name}}" data-id="{{$u->id}}" type="button" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            @foreach($u->questions as $q)
                            
                                <img width="20%" src="{{ URL::to('../') }}/storage/app/public/{{$q->photo_url}}"/>
                                <div>{{$q->question}}</div>
                                <div>
                                    {{$q->answer_a}}
                                </div>
                                <div>
                                    {{$q->answer_b}}
                                </div>
                                <div>
                                    {{$q->answer_c}}
                                </div>
                                <select>
                                    <option>{{$q->correct_answer}}</option>
                                </select>
                                <div>{{$q->unit_id}}</div>
                            @endforeach
                        </div>  
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection