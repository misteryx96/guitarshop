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




    @isset($guit)

            <div class="col-md-4 text-center col-sm-6 col-xs-6">
                <div class="thumbnail product-box">
                    <img src="{{ $guit->putanja_slike }}" alt=""/>
                    <div class="caption">
                        <h3>{{ $guit->naziv }}</h3>
                        <p>Cena:  <strong>{{ $guit->cena }}</strong>  </p>
                        <p>{{ $guit->opis }}</p>
                        <p><a href="{{ asset('/guit_order/' . $guit->id_gitara) }}" class="btn btn-success" role="button">Naruci</a> </p>
                    </div>
                </div>
            </div>



    @endisset


@endsection