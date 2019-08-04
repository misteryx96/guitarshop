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

    <form action="{{ (isset($galerija))? asset('/galls/update/'.$galerija->id)  : asset('/galls/store') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label>Naziv</label>
            <input type="text" name="tbNaziv" class="form-control" value="{{ (isset($galerija))? $galerija->naziv : old('tbNaziv') }}"/>
        </div>
            <label>Slika:</label>

            @isset($galerija)
                <img src="{{ asset($galerija->putanja_slike) }}" width="150"/>
            @endisset

            <input type="file" name="tbPic" class="form-control"  />

        </div>
        <div class="form-group">
            <input type="submit" name="addGall" value="{{ (isset($galerija))? 'Change gall' : 'Add gall' }} " class="btn btn-default" />
        </div>
    </form>

    <table class="table">
        <tr>
            <td>Id</td>
            <td>Naziv</td>
            <td>Slika</td>
        </tr>
        <!-- Prikaz korisnika-->
        @isset($galerije)
            @foreach($galerije as $galerija)
                <tr>
                    <td> {{ $galerija->id }} </td>
                    <td> {{ $galerija->naziv }} </td>
                    <td> <img src="{{ asset($galerija->putanja_slike) }}" width="150"/> </td>
                    <td> <a href="{{ asset('/galls/'.$galerija->id) }}">Izmeni</a> </td>
                    <td> <a href="{{ asset('/galls/destroy/'.$galerija->id) }}">Obrisi</a> </td>
                </tr>
            @endforeach
        @endisset
    </table>
	

@endsection