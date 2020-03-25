@extends('layouts.app')

@php( $admins = \App\User::all())
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ELIMINAR</div>
                <div class="card-body">
                    <form method="POST" action="{{ action('UserController@deleteAdmin') }}" role="form">
                        {{ method_field('DELETE') }}
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <select class="form-control mx-sm-3 mb-2" style="max-width: 41rem" name="id" required>
                            <option value=""></option>
                            @foreach($admins as $s)
                                <option value="{{$s->id}}">{{$s->id}}. {{$s->name}}  |  {{$s->email}} </option>
                            @endforeach
                        </select>
                        <p style="margin-left: 1rem"><input type="checkbox" required/>  Se que voy a borrar un admin</p>
                        <input style="margin-top: 1rem" type="submit" class="btn btn-light btn-lg btn-block" value="ELIMINAR"/>
                    </form>
                    <input style="margin-top: 1rem" type="button" class="btn btn-light btn-lg btn-block" value="ATRAS" onclick="location.href = '{{ route('admins') }}'"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection