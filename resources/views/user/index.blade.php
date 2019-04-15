@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(\Illuminate\Support\Facades\Auth::user()->role->name === 'admin')
                            <a class="btn btn-primary" href="{{ route('user.create') }}">
                                Přidat
                            </a>
                        @endif
                        <div class="text-center">
                            Uživatelé
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th> Č. </th>
                                <th> Jméno </th>
                                <th> Email </th>
                                <th> Role </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $i => $user)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>
                                        <a href="{{ route('user.detail', ['userId' => $user->id]) }}">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role->name === 'portfolio_manager')
                                            Portfolio manažer
                                        @elseif($user->role->name === 'project_manager')
                                            Projekt manažer
                                        @else
                                            Administrátor
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection