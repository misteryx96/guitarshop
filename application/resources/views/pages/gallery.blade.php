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

    @isset($galls)

        @foreach($galls as $gall)
            <div class="col-md-4 text-center col-sm-6 col-xs-6">
                <div class="thumbnail product-box">
                    <a href="{{ asset($gall->putanja_slike) }}"><img src="{{ $gall->putanja_slike }}" alt=""/></a>
                    <div class="caption">
                        <p>Naziv:  <strong>{{ $gall->naziv }}</strong>  </p>
                    </div>
                </div>
            </div>
        @endforeach

    @endisset

    {{ $galls->links() }}




@endsection