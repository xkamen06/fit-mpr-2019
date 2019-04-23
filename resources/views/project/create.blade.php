@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projekty</a></li>
                <li class="breadcrumb-item active" aria-current="page">Přidat projekt</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">
                            Vytvořit nový projekt
                        </h2>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('project.save')  }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-8" for="name">Název</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="name" id="name" type="text" required>
                                </div>
                                <br>
                                <label class="control-label col-sm-8" for="estimated_time">Odhadovaný čas v
                                    hodinách</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input class="form-control" name="estimated_time" id="estimated_time"
                                               type="number" required>
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
                                               type="number" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kč</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <label class="control-label col-sm-8" for="date_from">Datum zahájení</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="date_from" id="date_from" type="date" required>
                                </div>
                                <br>
                                <label class="control-label col-sm-8" for="date_to">Datum ukončení</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="date_to" id="date_to" type="date" required>
                                </div>
                                <br>
                                <label class="control-label col-sm-8" for="manager">Manažer projektu</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="manager" id="manager" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="control-label col-sm-2" for="file_attachment">Příloha</label>
                                <div class="col-sm-8">
                                    <input name="file_attachment" id="file_attachment" type="file">
                                </div>
                                <br>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" title="Vytořit"
                                            class="btn btn-primary">
                                        Vytvořit
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