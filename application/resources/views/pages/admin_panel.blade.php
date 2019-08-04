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

    <a href="{{ asset('/users') }}" >Korisnici</a><br><br>
    <a href="{{ asset('/galls') }}" >Galerija</a><br><br>
    <a href="{{ asset('/guits') }}" >Gitare</a><br><br>
    <a href="{{ asset('/menus') }}" >Meni</a><br><br>
    <a href="{{ asset('/orders') }}" >Narudzbina</a><br><br>
    <a href="{{ asset('/roles') }}" >Uloga</a><br>

@endsection