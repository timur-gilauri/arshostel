@extends('administrator.layouts.app')

@section('content')

    @include('administrator.blocks.errors')
    @include('administrator.blocks.session-message')

    <div class="d-flex mt-2 mb-2 justify-content-end">
        <a href="{{route('admin::rooms::create')}}" class="btn btn-primary">Добавить комнату</a>
    </div>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Название</th>
            <th scope="col">Количество мест</th>
            <th scope="col">Цена</th>
            <th scope="col">Доступность</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <th scope="row">{{$item->getId()}}</th>
                <td>{{$item->getTitle()}}</td>
                <td>{{$item->getBeds()}}</td>
                <td>{{$item->getPrice()}}</td>
                <td>{{$item->getAvailable()}}</td>
                <td>
                    <a href="{{route('admin::rooms::edit', $item->getId())}}" class="btn btn-info">Редактировать</a>
                </td>
                <td>
                    <a href="{{route('admin::rooms::delete', $item->getId())}}" class="btn btn-danger">Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection