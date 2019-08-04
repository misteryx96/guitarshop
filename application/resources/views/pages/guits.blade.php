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




    @isset($guits)
        @foreach($guits as $guit)
                <div class="col-md-4 text-center col-sm-6 col-xs-6">
                    <div class="thumbnail product-box">
                        <a href="{{ asset('/guits_show/' . $guit->id_gitara) }}"><img src="{{ $guit->putanja_slike }}" alt=""/></a>
                        <div class="caption">
                            <h3><a href="{{ asset('/guits_show/' . $guit->id_gitara) }}">{{ $guit->naziv }}</a></h3>
                            <p>Cena:  <strong>{{ $guit->cena }}</strong> din  </p>
                            <p><a href="{{ asset('/guits_show/' . $guit->id_gitara) }}">Detaljnije</a>
                        </div>
                    </div>
                </div>


        @endforeach
    @endisset


@endsection