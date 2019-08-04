@extends('layouts.front')

@section('container_2')

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
    <form action="{{ route('reg') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Korisničko ime:</label><br>
            <input type="text" name="tbUsername" class="form-control-mine" required id="tbUsername" onblur="reg(); return false;"/>
        </div>

        <div class="form-group">
            <label>Lozinka:</label><br>
            <input type="password" name="tbPass" class="form-control-mine" required id="tbPass"/>
        </div>

        <div class="form-group">
            <label>Slika:</label>
            <input type="file" name="tbPic" class="form-control-mine"  />
        </div>

        <input type="submit" name="btnLogin" value="Registruj se" class="btn btn-primary"/>
    </form>
    <!--// LOGIN FORMA -->

@endsection

@section('appendJs')
    @parent
    <script src="{{asset('js/reg.js')}}"></script>
@endsection