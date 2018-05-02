@if(count($errors))
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                @if(is_object($error) && method_exists($error, 'getMessage'))
                    <li>{{$error->getMessage()}}</li>
                @else
                    <li>{{$error}}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif