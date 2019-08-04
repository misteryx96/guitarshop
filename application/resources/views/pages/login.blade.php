@extends('layouts.front')

@section('container_1')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- LOGIN FORMA SREDI-->
<form action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Korisničko ime:</label><br>
        <input type="text" name="tbUsername" class="form-control-mine" />
    </div>

    <div class="form-group">
        <label>Lozinka:</label><br>
        <input type="password" name="tbPass" class="form-control-mine"/>
    </div>

    <input type="submit" name="btnLogin" value="Login" class="btn btn-primary"/>
</form>
<!--// LOGIN FORMA -->

@endsection