@extends('administrator.layouts.app')


@section('content')
    @include('administrator.blocks.errors')
    @include('administrator.blocks.session-message')

    <form class="mb-5" method="post" action="{{route('admin::rooms::save')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" value="{{isset($item) ? $item->getId() : null}}" name="id">
        <div class="form-group">
            <label for="title">Название комнаты</label>
            <input type="text"
                   class="form-control"
                   id=title
                   name=title
                   value="{{isset($item) ? $item->getTitle() : ''}}"
                   required>
        </div>

        <div class="form-group">
            <label for="type">Тип комнаты</label>
            <select class="form-control" id="type" name="type" required>
                <option value="">--- Выберите ---</option>
                @foreach(\App\Models\Room::TYPES as $type => $text)
                    <option value="{{$type}}" {{isset($item) && $item->getType() == $type ? 'selected' : ''}}>{{$text}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="beds">Количество мест</label>
            <input type="number"
                   class="form-control"
                   id="beds"
                   name="beds"
                   min="0" max="8"
                   value="{{isset($item) ? $item->getBeds() : 0}}"
                   required>
        </div>

        <div class="form-group">
            <label for="beds_available">Количество свободных мест</label>
            <input type="number"
                   class="form-control"
                   id="beds_available"
                   name="beds_available"
                   min="0" max="8"
                   value="{{isset($item) ? $item->getBedsAvailable() : 0}}">
        </div>

        <div class="form-group">
            <label for="price">Цена</label>
            <input type="number"
                   class="form-control"
                   id="price"
                   name="price"
                   min="0"
                   value="{{isset($item) ? $item->getPrice() : 0}}"
                   required>
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control"
                      id="description"
                      name="description"
                      rows="3">{{isset($item) ? $item->getDescription() : ''}}</textarea>
        </div>

        <div class="form-group">
            <input type="checkbox"
                   class="checkbox"
                   id="available"
                   name="available" {{isset($item) && $item->isAvailable() ? 'checked' : ''}}/>
            <label for="available">Доступна</label>
        </div>

        <div class="form-group">
            <div class="custom-file">
                <input type="file"
                       class="custom-file-input"
                       id="image"
                       name="image"
                       accept="image/*"
                        {{!isset($item) ? 'required' : ''}}>
                <label class="custom-file-label" for="image">Выберите изображение</label>
            </div>
        </div>

        @include('administrator.blocks.image-on-edit-form', ['width' => 200, 'height'=>200, 'url' => 'thumb'])

        <div class="row mt-4">
            <div class="col">
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{route('admin::rooms::index')}}" class="btn btn-danger">Отменить</a>
                </div>
            </div>
        </div>
    </form>
@endsection