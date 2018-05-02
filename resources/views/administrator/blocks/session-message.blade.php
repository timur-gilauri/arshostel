@if($message = session('message'))
    <div class="alert alert-{{session('color') ?? 'success'}}" role="alert">
        {{$message}}
    </div>
@endif