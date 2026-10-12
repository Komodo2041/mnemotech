@extends('template')
@section('content')

<h3>Lista Mnemono</h3>
<a href="/add" class="btn btn-info">Dodaj następne</a>
<div class="container">
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Nazwa</th>
        </tr>
        @foreach ($mlist AS $record)
        <tr>
            <td>{{$record->id}}</td>
            <td>{{$record->name}}</td>
        </tr>

        @endforeach
    </table>

</div>



@endsection('content')