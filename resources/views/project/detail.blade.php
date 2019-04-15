@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            Projekt <b>{{ $project->name }}"</b>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h1>{{ $project->name }}</h1>
                        @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin' ||
                            \Illuminate\Support\Facades\Auth::user()->role === 'portfolio' ||
                             \Illuminate\Support\Facades\Auth::id() === $project->id_user)
                            <a class="btn btn-outline-primary" href="{{ route('project.edit', ['projectId' => $project->id]) }}">Upravit</a>
                            <br><br>
                        @endif
                        <b>Projektový manažer: </b>
                        <a href="{{ route('user.detail', ['userId' => $project->author->id]) }}">
                            {{ $project->author->name }}
                        </a>
                        <br><br>
                        <b>Odhadovaný čas: </b> {{ $project->estimated_time }} hodin
                        <br><br>
                        <b>Odhadovaná cena: </b> {{ $project->estimated_price }} Kč
                        <br><br>
                        <b>Od: </b>{{ $project->date_from }}
                        <br><br>
                        <b>Do: </b>{{ $project->date_to }}
                        <br><br>
                        <b>Status:</b> {{ $project->status }}
                        @if(Auth::user()->role === 'admin' ||
                            Auth::user()->role === 'portfolio' ||
                            Auth::id() === $project->id_user)
                            <a class="btn btn-outline-primary" href="{{ route('project.status.edit', ['projectId' => $project->id]) }}">
                                Změnit status
                            </a>
                        @endif
                        <br><br>
                        <hr>
                        <h2>Aktuální fáze
                            <a class="btn btn-outline-primary" href="{{ route('phase.index', ['projectId' => $project->id]) }}">
                                Zobrazit všechny fáze projektu
                            </a>
                        </h2>
                        @if($project->actualPhase)
                            <h4>{{ $project->actualPhase->phaseEnum->name }}</h4>
                            @if(Auth::user()->role === 'admin' ||
                                Auth::user()->role === 'portfolio' ||
                                Auth::id() === $project->id_user ||
                                Auth::id() === $project->actualPhase->id_user)
                                <a class="btn btn-outline-primary" href="{{ route('phase.edit', ['phaseId' => $project->actualPhase->id]) }}">Upravit aktuální fázi</a>
                            @endif
                            @if(Auth::user()->role === 'admin' ||
                                Auth::user()->role === 'portfolio' ||
                                Auth::id() === $project->id_user)
                                <a class="btn btn-outline-primary" href="{{ route('phase.change', ['projectId' => $project->id]) }}">Změnit aktuální fázi</a>
                            @endif
                            <br>
                            <b>Zodpovědná osoba:</b>
                            <a href="{{ route('user.detail', ['userId' => $project->actualPhase->author->id]) }}">
                                {{ $project->actualPhase->author->name }}
                            </a>
                            <br>
                            <b>Cena:</b> {{ $project->actualPhase->price }} Kč
                            <br>
                            <b>Uplynulý čas:</b> {{ $project->actualPhase->spent_time }} hodin
                            <br>
                            <b>Od:</b> {{ $project->actualPhase->date_from }}
                            <br>
                            <b>Do:</b> {{ $project->actualPhase->date_to }}
                            <br>
                            <b>Popis:</b> {{ $project->actualPhase->description }}
                        @else
                            Projekt je dokončený
                        @endif
                        <br>
                        <hr>
                        <h2>Soubory</h2>
                        <br>
                        <hr>
                        <h2>Komentáře</h2>
                        <br>
                        <form class="form-horizontal" action="{{ route('note.create', ['projectId' => $project->id])  }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <input class="form-control" name="content" id="content" type="text">
                                </div>
                                <br>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" title="Přidat"
                                            class="btn btn-outline-primary">
                                        Přidat
                                    </button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped">
                        <thead>
                        </thead>
                        <tbody>
                            @foreach($project->comments as $comment)
                                <tr>
                                    <a href="{{ route('user.detail', ['userId' => $comment->author->id]) }}">
                                        {{ $comment->author->name }}
                                    </a>
                                    {{ $comment->created_at }}
                                    <br>
                                    {{ $comment->content }}
                                    <hr>
                                </tr>
                            @endforeach
                        </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection