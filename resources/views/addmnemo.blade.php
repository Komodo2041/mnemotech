@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>Dodaj Mnemo</h3>

@if (isset($errorforms) && $errorforms != "")
<div class="alert alert-danger" role="alert">
    {{$errorforms}}
</div>
@endif

<div class="container">
    <form action="" method="Post">
        @csrf
        <h4>{{$max}}</h4>
        <div class="form-group">
            <label>Nazwa</label>
            <input type="text" name="name" class="form-control" placeholder="Nazwa" value="{{$name}}">
        </div>

        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" @if ($op==0 ) value="Dodaj" @else value="Edytuj" @endif />
        </div>
    </form>


</div>

@endsection('content')