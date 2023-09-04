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
                    <li class="list-group-item">age: {{ $person->age ? $person->age : 'not set' }}</li>
                    <li class="list-group-item">gender: {{ $person->gender ? $person->gender : 'not set' }}</li>

                </ul>
            </div>

        </div>

        <div class="conttainer">
            <a href="{{ route('homepage') }}" class="btn btn-warning">
                HOME
            </a>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="container mt-4">
                        <h2>Friends</h2>
                        <ul class="my-4">
                            @foreach ($friends as $friend)
                                <li class="list-group-item my-2">
                                    <a href="{{ route('person.show', $friend->id) }}"
                                        class="btn {{ $friend->gender == 'male' ? 'btn-primary' : 'btn-danger' }}">
                                        ID: {{ $friend->id }}
                                        <br>
                                        {{ $friend->firstName }} {{ $friend->surname }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-4">
                    <div class="container mt-4">
                        <h2>Friends of Friend</h2>
                        <ul class="my-4">
                            @foreach ($friendOfFriend as $fof)
                                <li class="list-group-item my-2">
                                    <a href="{{ route('person.show', $fof->id) }}"
                                        class="btn {{ $fof->gender == 'male' ? 'btn-primary' : 'btn-danger' }}">
                                        ID: {{ $fof->id }}
                                        <br>
                                        {{ $fof->firstName }} {{ $fof->surname }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-4">
                    <div class="container mt-4">
                        <h2>Friends Suggesteds</h2>
                        <ul class="my-4">
                            @if ($friendsSuggested->isEmpty())
                                <h5>No suggestions</h5>
                            @else
                                @foreach ($friendsSuggested as $fs)
                                    <li class="list-group-item my-2">
                                        <a href="{{ route('person.show', $fs->id) }}"
                                            class="btn {{ $fs->gender == 'male' ? 'btn-primary' : 'btn-danger' }}">
                                            ID: {{ $fs->id }}
                                            <br>
                                            {{ $fs->firstName }} {{ $fs->surname }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
