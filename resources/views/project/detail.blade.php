@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projekty</a></li>
                <li class="breadcrumb-item active" aria-current="page">Projekt "{{ $project->name }}"</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">
                            Projekt <b>"{{ $project->name }}"</b>
                        </h2>
                    </div>
                    <div class="panel-body">

                        @if(\Illuminate\Support\Facades\Auth::user()->role->name === 'admin' ||
                            \Illuminate\Support\Facades\Auth::user()->role->name === 'portfolio' ||
                             \Illuminate\Support\Facades\Auth::id() === $project->id_user)
                            <div class="text-right mb-2">
                                <a class="btn btn-outline-primary"
                                   href="{{ route('project.edit', ['projectId' => $project->id]) }}">Upravit projekt</a>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card" style="height: 300px;">
                                    <h5 class="card-header">Základní informace</h5>
                                    <div class="card-body">
                                        <b>Projektový manažer: </b>
                                        <a href="{{ route('user.detail', ['userId' => $project->author->id]) }}">
                                            {{ $project->author->name }}
                                        </a>
                                        <br/>
                                        <b>Odhadovaný čas: </b> {{ $project->estimated_time }} hodin
                                        <br/>
                                        <b>Odhadovaná cena: </b> {{ $project->estimated_price }} Kč
                                        <br/>
                                        <b>Od: </b>{{ $project->date_from }}
                                        <br/>
                                        <b>Do: </b>{{ $project->date_to }}
                                        <br/>
                                        <b>Status:</b> {{ $project->status }}
                                        @if(Auth::user()->role->name === 'admin' ||
                                            Auth::user()->role->name === 'portfolio' ||
                                            Auth::id() === $project->id_user)
                                            <a class="btn btn-outline-primary btn-sm"
                                               href="{{ route('project.status.edit', ['projectId' => $project->id]) }}">
                                                Změnit status
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card" style="height: 300px; overflow: scroll;">
                                    <h5 class="card-header">Komentáře</h5>
                                    <div class="card-body">
                                        <form class="mb-3"
                                              action="{{ route('note.create', ['projectId' => $project->id])  }}"
                                              method="post">
                                            {{ csrf_field() }}
                                            <div class="form-row">
                                                <div class="col-8">
                                                    <input class="form-control" name="content" id="content" type="text">
                                                </div>

                                                <div class="col-4">
                                                    <button type="submit" title="Přidat"
                                                            class="btn btn-outline-primary form-control">
                                                        Přidat komentář
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <table class="table table-striped">
                                            <tbody>
                                            @foreach($project->comments as $comment)
                                                <tr>
                                                    <a href="{{ route('user.detail', ['userId' => $comment->author->id]) }}">
                                                        {{ $comment->author->name }}
                                                    </a>
                                                    {{ $comment->created_at->diffForHumans() }}
                                                    <br>
                                                    {{ $comment->content }}
                                                    <hr>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <div class="card ">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs pull-right">
                                            @foreach($project->phases as $phase)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $project->actualPhase != null && $phase->phaseEnum->id == $project->actualPhase->phaseEnum->id ? 'active' : '' }}"
                                                       data-toggle="tab"
                                                       href="#phase-{{ $phase->phaseEnum->id }}">
                                                        @if($phase->state === 'V řešení')
                                                            <span class="text-primary">{{ $phase->phaseEnum->getShortName($phase->phaseEnum->id) }}</span>
                                                        @elseif($phase->state === 'Dokončený')
                                                            <span class="text-success">{{ $phase->phaseEnum->getShortName($phase->phaseEnum->id) }}</span>
                                                        @else
                                                            <span class="text-dark">{{ $phase->phaseEnum->getShortName($phase->phaseEnum->id) }}</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            @foreach($project->phases as $phase)
                                                <div class="tab-pane fade  {{ $project->actualPhase != null && $phase->phaseEnum->id == $project->actualPhase->phaseEnum->id ? 'show active' : '' }}"
                                                     id="phase-{{ $phase->phaseEnum->id }}">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4>{{ $phase->phaseEnum->name }}</h4>
                                                        </div>

                                                        <div class="col-md-6 text-right">
                                                            @if(Auth::user()->role->name === 'admin' ||
                                                            Auth::user()->role->name === 'portfolio' ||
                                                            Auth::id() === $project->id_user ||
                                                            Auth::id() === $phase->id_user)
                                                                <a class="btn btn-outline-primary"
                                                                   href="{{ route('phase.edit', ['phaseId' => $phase->id]) }}">
                                                                    Upravit aktuální fázi
                                                                </a>
                                                            @endif
                                                            @if(Auth::user()->role->name === 'admin' ||
                                                                Auth::user()->role->name === 'portfolio' ||
                                                                Auth::id() === $project->id_user)
                                                                <a class="btn btn-outline-primary"
                                                                   href="{{ route('phase.change', ['projectId' => $project->id]) }}">
                                                                    Změnit aktuální fázi
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <b>Zodpovědná osoba:</b>
                                                    <a href="{{ route('user.detail', ['userId' => $phase->author->id]) }}">
                                                        {{$phase->author->name }}
                                                    </a>
                                                    <br>
                                                    <b>Stav:</b>
                                                    @if($phase->state === 'V řešení')
                                                        <span class="text-primary">{{ $phase->state }}</span>
                                                    @elseif($phase->state === 'Dokončený')
                                                        <span class="text-success">{{ $phase->state }}</span>
                                                    @else
                                                        <span class="text-dark">{{ $phase->state }}</span>
                                                    @endif
                                                    <br>
                                                    <b>Cena:</b> {{ $phase->price }} Kč
                                                    <br>
                                                    <b>Uplynulý čas:</b> {{ $phase->spent_time }} hodin
                                                    <br>
                                                    <b>Od:</b> {{ $phase->date_from }}
                                                    <br>
                                                    <b>Do:</b> {{ $phase->date_to }}
                                                    <br>
                                                    <b>Popis:</b> {{ $phase->description }}
                                                    <hr>
                                                    <h5>Soubory</h5>
                                                    @forelse($phase->files as $file)
                                                        @if($loop->first)
                                                            <ul> @endif
                                                                <li>
                                                                    <a href="{{ route('file.download', ['fileId' => $file->id]) }}">{{$file->name}}</a>
                                                                    <a href="{{ route('file.delete', ['fileId' => $file->id]) }}"
                                                                       class="btn btn-sm btn-danger">Smazat</a>
                                                                </li>
                                                                @if($loop->last) </ul> @endif
                                                    @empty
                                                        <p class="alert alert-info">Nebyly nalezeny žádné soubory</p>
                                                    @endforelse
                                                    <br>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection