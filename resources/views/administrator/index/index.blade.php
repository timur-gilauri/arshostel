@extends('administrator.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Панель</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            Вы авторизовались!
        </div>
    </div>
@endsection
