@extends('layouts.main-layout')

@section('title')
    SocialGraph
@endsection

@section('content')
    <div class="container text-center">
        <h1>users</h1>
        <div class="row">
            @foreach ($people as $person)
                <div class="col-3 mb-4">
                    <a href="{{ route('person.show', $person->id) }}" class="text-decoration-none">
                        <div
                            class="card {{ $person->gender == 'male' ? 'border-primary btn btn-primary' : 'border-danger btn btn-danger' }}">
                            <div class="card-body">

                                {{ $person->firstName }} {{ $person->surname }}

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    @endsection
