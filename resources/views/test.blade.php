@extends('template')
@section('content')

<a href="/" class=" btn btn-primary"> Strona główna</button></a>
<h3>TEST - Wersja {{$v}} - Numer {{$nr}}</h3>


<div class="container">
    @if ($op == 1)
    <form action="" method="Post">
        @csrf

        <table class="table">
            <tr>

                <th>Name</th>
                <th>Wynik</th>
            </tr>
            @for ($i = 0; $i < $nr; $i++)
                <tr>

                <td>{{$list[$i]}}</td>
                <td>
                    <input type="text" name="val[{{$i}}]" class="form-control" placeholder="Nazwa" value="">
                </td>
                </tr>
                @endfor
        </table>
        <br />

        <div class="form-group">
            <input type="hidden" value="1" name="save" />
            <input type="hidden" value="{{$chc}}" name="chc" />
            <input type="submit" class="btn btn-info" value="Testuj" />
        </div>
    </form>
    @else

    <a href="" class="btn btn-info">Jeszcze raz</a><br /><br />
    <h4>{{$res}} / {{$nr}}</h4>
    @if ($res == $nr)
    <h4>Poprawnie</h4>
    @else
    <h4>Źle</h4>
    @endif
    <table class="table">
        <tr>

            <th>Name</th>
            <th>Wynik</th>
            <th>#</th>
        </tr>
        @for ($i = 0; $i < $nr; $i++)
            <tr>

            <td>{{$goods[$i]}}</td>
            <td>
                {{$values[$i]}}
            </td>
            <td>
                @if ($anno[$i] == 1)
                GOOD
                @else
                BAD
                @endif
            </td>
            </tr>
            @endfor
    </table>

    @endif

</div>

@endsection('content')