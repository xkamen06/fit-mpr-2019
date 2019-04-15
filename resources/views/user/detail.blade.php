@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            Uživatel <b>{{ $user->name }}"</b>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if($user->id === \Illuminate\Support\Facades\Auth::id() || \Illuminate\Support\Facades\Auth::user()->role->name === 'admin')
                            <a class="btn btn-secondary" href="{{ route('user.edit', ['userId' => $user->id]) }}">Upravit</a>
                        @endif
                        <br><br>
                        <b>Jméno: </b> {{ $user->name }}
                        <br><br>
                        <b>Email: </b> {{ $user->email }}
                        <br><br>
                        <b>Role: </b>
                        @if($user->role->name === 'portfolio_manager')
                            Portfolio manažer
                        @elseif($user->role->name === 'project_manager')
                            Projekt manažer
                        @else
                            Administrátor
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection