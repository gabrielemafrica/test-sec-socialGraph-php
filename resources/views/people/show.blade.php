@extends('layouts.main-layout')

@section('title')
    SocialGraph
@endsection

@section('content')
    <div class="container text-center py-4">
        <h1>USER ID: {{ $person->id }}</h1>
        <div class="container d-flex justify-content-center my-4">


            <div class="card {{ $person->gender == 'male' ? 'text-bg-primary' : 'text-bg-danger' }}" style="width: 18rem;">
                <div class="card-header">
                    {{ $person->firstName }} {{ $person->surname }}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">age: {{ $person->age }}</li>
                    <li class="list-group-item">gender: {{ $person->gender }}</li>
                </ul>
            </div>





        </div>
    @endsection
