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



   <!-- <form action="{{ (isset($menu))? asset('/menus/update/'.$menu->id_gitara)  : asset('/menus/store') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label>Naziv:</label>
            <input type="text" name="tbNaziv" class="form-control" value="{{ (isset($menu))? $menu->naziv : old('tbNaziv') }}"/>
        </div>
        <div class="form-group">
            <label>Link:</label>
            <input type="text" name="tbLink" class="form-control" value="{{ (isset($menu))? $menu->marka : old('tbLink') }}"/>
        </div>


        </div>

        <div class="form-group">
            <input type="submit" name="addGuit" value="{{ (isset($menu))? 'Change menu' : 'Add menu' }} " class="btn btn-default" />
        </div>
    </form> -->

    <table class="table">
        <tr>
            <td>Id</td>
            <td>Naziv</td>
            <td>Link</td>
        </tr>
        <!-- Prikaz korisnika-->
        @isset($menus)
            @foreach($menus as $menu)
                <tr>
                    <td> {{ $menu->id }} </td>
                    <td> {{ $menu->naziv }} </td>
                    <td> {{ $menu->link }} </td><!--
                    <td> <a href="{{ asset('/menus/'.$menu->id) }}">Izmeni</a> </td>
                    <td> <a href="{{ asset('/menus/destroy/'.$menu->id) }}">Obrisi</a> </td> -->
                </tr>
            @endforeach
        @endisset
    </table>

@endsection