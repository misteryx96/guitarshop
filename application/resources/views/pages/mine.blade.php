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

    <img src="{{ asset('/pics/main/ja.jpg') }}"/>
    <br><br>

    @isset($mine)

    @foreach($mine as $min)
        <p>{{ $min->autor_text }}</p>
    @endforeach


    @endisset


@endsection