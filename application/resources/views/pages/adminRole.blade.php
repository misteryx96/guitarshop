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





    <table class="table">
        <tr>
            <td>Id</td>
            <td>Naziv</td>
        </tr>
        @isset($roles)
            @foreach($roles as $role)
                <tr>
                    <td> {{ $role->id }} </td>
                    <td> {{ $role->naziv }} </td>
                </tr>
            @endforeach
        @endisset
    </table>

@endsection