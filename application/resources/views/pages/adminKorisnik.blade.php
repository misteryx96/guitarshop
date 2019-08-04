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

    @empty(!session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endempty

    <form action="{{ (isset($korisnik))? asset('/users/update/'.$korisnik->id)  : asset('/users/store') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label>Korisnicko ime:</label>
            <input type="text" name="tbUsername" class="form-control" value="{{ (isset($korisnik))? $korisnik->username : old('tbUsername') }}"/>
        </div>
        <div class="form-group">
            <label>Lozinka:</label>
            <input type="password" name="tbPass" class="form-control" value="{{ (isset($korisnik))? $korisnik->pass : old('tbPass') }}"/>
        </div>
        <div class="form-group">
            <label>Slika:</label>

            @isset($korisnik)
                <img src="{{ asset($korisnik->slika) }}" width="150"/>
            @endisset

            <input type="file" name="tbPic" class="form-control"  />

        </div>
        <div class="form-group">
            <label>Uloga:</label>
            <select name="ddlUloga">
                <option value="0">Izaberite</option>

                @foreach($uloge as $uloga)
                    <option value="{{ $uloga->id }}" {{ (isset($korisnik) && $korisnik->uloga_id == $uloga->id)? 'selected' : (old('ddlUloga')==$uloga->id)? 'selected' : '' }} > {{ $uloga->naziv }} </option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="addKorisnik" value="{{ (isset($korisnik))? 'Change korisnik' : 'Add korisnik' }} " class="btn btn-default" />
        </div>
    </form>

    <table class="table">
        <tr>
            <td>Id</td>
            <td>Username</td>
            <td>Slika</td>
            <td>Uloga</td>
            <td>Izmeni</td>
            <td>Obriši</td>
        </tr>
        <!-- Prikaz korisnika-->
        @isset($korisnici)
            @foreach($korisnici as $korisnik)
                <tr>
                    <td> {{ $korisnik->korisnikId }} </td>
                    <td> {{ $korisnik->username }} </td>
                    <td> <img src="{{ asset($korisnik->slika) }}" width="150"/> </td>
                    <td> {{ $korisnik->naziv }} </td>
                    <td> <a href="{{ asset('/users/'.$korisnik->korisnikId) }}">Izmeni</a> </td>
                    <td> <a href="{{ asset('/users/destroy/'.$korisnik->korisnikId) }}">Obrisi</a> </td>
                </tr>
            @endforeach
        @endisset
    </table>

@endsection