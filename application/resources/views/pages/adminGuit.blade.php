<@extends('layouts.front')

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



    <form action="{{ (isset($guit))? asset('/guits/update/'.$guit->id_gitara)  : asset('/guits/store') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label>Naziv:</label>
            <input type="text" name="tbNaziv" class="form-control" value="{{ (isset($guit))? $guit->naziv : old('tbNaziv') }}"/>
        </div>
        <div class="form-group">
            <label>Marka:</label>
            <input type="text" name="tbMarka" class="form-control" value="{{ (isset($guit))? $guit->marka : old('tbMarka') }}"/>
        </div>
        <div class="form-group">
            <label>Tip:</label>
            <input type="text" name="tbTip" class="form-control" value="{{ (isset($guit))? $guit->tip : old('tbTip') }}"/>
        </div>
        <div class="form-group">
            <label>Opis:</label>
            <input type="text" name="tbOpis" class="form-control" value="{{ (isset($guit))? $guit->opis : old('tbOpis') }}"/>
        </div>
        <div class="form-group">
            <label>Cena:</label>
            <input type="text" name="tbCena" class="form-control" value="{{ (isset($guit))? $guit->cena : old('tbCena') }}"/>
        </div>
        <div class="form-group">
            <label>Slika:</label>

            @isset($guit)
                <img src="{{ asset($guit->putanja_slike) }}" width="150"/>
            @endisset

            <input type="file" name="tbSlika" class="form-control"  />

        </div>

        <div class="form-group">
            <input type="submit" name="addGuit" value="{{ (isset($guit))? 'Change guit' : 'Add guit' }} " class="btn btn-default" />
        </div>
    </form>

    <table class="table">
        <tr>
            <td>Id</td>
            <td>Naziv</td>
            <td>Marka</td>
            <td>Tip</td>
            <td>Opis</td>
            <td>Cena</td>
            <td></td>
            <td>Izmeni</td>
            <td>Obrisi</td>
        </tr>
        <!-- Prikaz korisnika-->
        @isset($guits)
            @foreach($guits as $guit)
                <tr>
                    <td> {{ $guit->id_gitara }} </td>
                    <td> {{ $guit->naziv }} </td>
                    <td> {{ $guit->marka }} </td>
                    <td> {{ $guit->tip }} </td>
                    <td> {{ $guit->opis }} </td>
                    <td> {{ $guit->cena }} </td>
                    <td> <img src="{{ asset($guit->putanja_slike) }}" width="150"/> </td>
                    <td> <a href="{{ asset('/guits/'.$guit->id_gitara) }}">Izmeni</a> </td>
                    <td> <a href="{{ asset('/guits/destroy/'.$guit->id_gitara) }}">Obrisi</a> </td>
                </tr>
            @endforeach
        @endisset
    </table>

@endsection