@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">
                            Uživatel <b>{{ $user->name }}"</b>
                        </h2>
                    </div>
                    <div class="panel-body">
                        @if($user->id === \Illuminate\Support\Facades\Auth::id() || \Illuminate\Support\Facades\Auth::user()->role->name === 'admin')
                            <div class="text-right mb-2">
                                <a class="btn btn-primary" href="{{ route('user.edit', ['userId' => $user->id]) }}">Upravit</a>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
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
        </div>
    </div>
@endsection