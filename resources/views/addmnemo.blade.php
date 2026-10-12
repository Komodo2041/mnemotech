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
        <div class="form-group">
            <label>Nazwa</label>
            <input type="text" name="name" class="form-control" placeholder="Nazwa" value="{{$name}}">
        </div>

        <div class="form-group">
            <input type="hidden" value="1" name="save" />

            <input type="submit" class="btn btn-info" value="Dodaj" />
        </div>
    </form>


</div>

@endsection('content')