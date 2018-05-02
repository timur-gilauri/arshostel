@extends('administrator.layouts.app')


@section('content')
    @include('administrator.blocks.errors')
    @include('administrator.blocks.session-message')

    <form class="mb-5" method="post" action="{{route('admin::reviews::save')}}">
        {{csrf_field()}}
        <input type="hidden" value="{{isset($item) ? $item->getId() : null}}" name="id">
        <div class="form-group">
            <label for="author_name">Имя автора</label>
            <input type="text"
                   class="form-control"
                   id=author_name
                   name=author_name
                   value="{{isset($item) ? $item->getAuthorName() : ''}}"
                   required>
        </div>

        <div class="form-group">
            <label for="content">Содержание отзыва</label>
            <textarea class="form-control"
                      id="content"
                      name="content"
                      required
                      rows="5">{{isset($item) ? $item->getContent() : ''}}</textarea>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{route('admin::reviews::index')}}" class="btn btn-danger">Отменить</a>
                </div>
            </div>
        </div>
    </form>
@endsection