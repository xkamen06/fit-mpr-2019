@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            Fáze
                        </div>
                    </div>
                    <div class="panel-body">
                        @foreach($phases as $phase)
                            <h4>{{ $phase->phaseEnum->name }}</h4>
                            <b>Zodpovědná osoba:</b>
                            <a href="{{ route('user.detail', ['userId' => $phase->author->id]) }}">
                                {{$phase->author->name }}
                            </a>
                            <br>
                            <b>Stav:</b>
                            @if($phase->state === 'V řešení')
                                <span class="btn-success">{{ $phase->state }}</span>
                            @else
                                {{ $phase->state }}
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
                            <br>
                            <hr>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection