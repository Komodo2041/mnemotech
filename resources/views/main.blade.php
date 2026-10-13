@extends('template')
@section('content')

<h3>Lista Mnemono</h3>
<a href="/add" class="btn btn-info">Dodaj następne</a><br /><br />
<a href="/testA/1/5" class="btn btn-info">Test A (5)</a>
<a href="/testB/2/5" class="btn btn-info">Test B (5)</a>
<a href="/testA/1/10" class="btn btn-info">Test A (10)</a>
<a href="/testB/2/10" class="btn btn-info">Test B (10)</a>
<div class="container">
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Nazwa</th>
            <th></th>
        </tr>
        @foreach ($mlist AS $record)
        <tr>
            <td>{{$record->id}}</td>
            <td>{{$record->name}}</td>
            <td><a href="/edit/{{$record->id}}" class="btn btn-info">Edit</a></td>
        </tr>

        @endforeach
    </table>

</div>



@endsection('content')