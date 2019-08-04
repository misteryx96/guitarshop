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
            <td>Gitara</td>
            <td>Narucio</td>
        </tr>
        @isset($orders)
            @foreach($orders as $order)
                <tr>
                    <td> {{ $order->id_narudzbina }} </td>
                    <td> {{ $order->naziv }} </td>
                    <td> {{ $order->username }} </td>
                </tr>
            @endforeach
        @endisset
    </table>

@endsection