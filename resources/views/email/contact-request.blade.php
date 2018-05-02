@component('mail::message')
<h2>Новый запрос с сайта {{env('APP_NAME')}}</h2>

@component('mail::table')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Телефон</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$entity->getName()}}</td>
            <td>{{$entity->getEmail()}}</td>
            <td>{{$entity->getPhone()}}</td>
        </tr>
        </tbody>
    </table>
@endcomponent

@if($entity->getMessage())
<br>

{{$entity->getMessage()}}

@endif
<br>

С уважение,<br>
АрсХостел
@endcomponent
