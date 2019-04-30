@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projekty</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.detail', ['projectId' => $project->id]) }}">Projekt "{{ $project->name }}"</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upravit aktuální fázi</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            Upravit aktuální fázi
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('phase.update', ['phaseId' => $phase->id])  }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="manager">Zodpovědná osoba</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="manager" id="manager" required>
                                        @foreach($users as $user)
                                            @if($user->id === $phase->id_user)
                                                <option value="{{ $user->id }}" selected>
                                                    {{ $user->name }}
                                                </option>
                                            @else
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="price">Cena</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="price" id="price" type="number" value="{{ $phase->price }}" required> Kč
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="estimated_time">Odpracovaný čas</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="spent_time" id="spent_time" type="number" value="{{ $phase->spent_time }}" required> hodin
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="date_from">Datum zahájení</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="date_from" id="date_from" type="date" value="{{ $phase->date_from }}" required>
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="date_to">Datum ukončení</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="date_to" id="date_to" type="date" value="{{ $phase->date_to }}" required>
                                </div>
                                <br>
                                <br>
                                <label class="control-label col-sm-2" for="estimated_price">Popis</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="description" id="description" type="text" value="{{ $phase->description }}" required>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" title="Upravit"
                                            class="btn btn-primary">
                                        Upravit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection