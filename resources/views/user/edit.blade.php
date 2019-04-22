@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">
                            Upravit uživatele
                        </h2>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('user.update', ['userId' => $user->id])  }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Jméno</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="name" id="name" type="text" value="{{ $user->name }}">
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="email">Email</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="email" id="email" type="email" disabled value="{{ $user->email }}">
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="password">Heslo</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="password" id="password" type="password" value="{{ $user->password }}">
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="role">Role</label>
                                <div class="col-sm-8">
                                    @if($user->id === \Illuminate\Support\Facades\Auth::id())
                                        <select class="form-control" name="role" id="role" disabled>
                                    @else
                                        <select class="form-control" name="role" id="role">
                                    @endif
                                        @foreach($roles as $role)
                                            @if($role->id === $user->role->id)
                                                <option value="{{ $role->id }}" selected>
                                                    @if($role->name === 'portfolio_manager')
                                                        Portfolio manažer
                                                    @elseif($role->name === 'project_manager')
                                                        Projekt manažer
                                                    @else
                                                        Administrátor
                                                    @endif
                                                </option>
                                            @else
                                                <option value="{{ $role->id }}">
                                                    @if($role->name === 'portfolio_manager')
                                                        Portfolio manažer
                                                    @elseif($role->name === 'project_manager')
                                                        Projekt manažer
                                                    @else
                                                        Administrátor
                                                    @endif
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