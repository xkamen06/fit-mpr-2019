@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projekty</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.detail', ['projectId' => $project->id]) }}">Projekt "{{ $project->name }}"</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upravit projekt</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">Editace projektu</h2>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal"
                              action="{{ route('project.update', ['projectId' => $project->id])  }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-8" for="name">Název</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="name" id="name" type="text"
                                           value="{{ $project->name }}" required>
                                </div>
                                <br>
                                <label class="control-label col-sm-8" for="estimated_time">Odhadovaný čas v
                                    hodinách</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input class="form-control" name="estimated_time" id="estimated_time"
                                               type="number"
                                               value="{{ $project->estimated_time }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">hodin</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <label class="control-label col-sm-8" for="estimated_price">Odhadovaná cena v Kč</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input class="form-control" name="estimated_price" id="estimated_price"
                                               type="number" value="{{ $project->estimated_price }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kč</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <label class="control-label col-sm-8" for="date_from">Datum zahájení</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="date_from" id="date_from" type="date"
                                           value="{{ $project->date_from }}" required>
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="date_to">Datum ukončení</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="date_to" id="date_to" type="date"
                                           value="{{ $project->date_to }}" required>
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="file_attachment">Příloha</label>
                                <div class="col-sm-8">
                                    <input name="file_attachment" id="file_attachment" type="file">
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="manager">Manažer projektu</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="manager" id="manager" required>
                                        @foreach($users as $user)
                                            @if($user->id === $project->id_user)
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