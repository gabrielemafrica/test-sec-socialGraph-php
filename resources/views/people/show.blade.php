@extends('layouts.main-layout')

@section('title')
    SocialGraph
@endsection

@section('content')
    <div class="container text-center py-4">
        <h1>USER ID: {{ $person->id }}</h1>

        <section>

            <div class="container d-flex justify-content-center my-4">

                {{-- card person --}}
                <div class="card {{ $person->gender == 'male' ? 'text-bg-primary' : 'text-bg-danger' }}"
                    style="width: 18rem;">
                    <div class="card-header">
                        {{ $person->firstName }} {{ $person->surname }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">AGE</h5>
                        <p class="card-text">{{ $person->age ? $person->age : 'not set' }}</p>

                        <h5 class="card-title">GENDER</h5>
                        <p class="card-text">{{ $person->gender ? $person->gender : 'not set' }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">CITIES VISITED</h5>
                            </div>
                            <div class="col-6">
                                <h5 class="card-title">RATING</h5>
                            </div>
                        </div>
                        <div class="container">
                            @foreach ($person->citiesVisited as $city)
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">{{ $city->city_name }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="card-text">{{ $city->rating }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            {{-- button home --}}
            <div class="conttainer">
                <a href="{{ route('homepage') }}" class="btn btn-warning">
                    HOME
                </a>
            </div>

        </section>

        {{-- buttom section --}}
        <section>
            <div class="container">
                <div class="row">

                    {{-- friends list --}}
                    <div class="col-3">
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

                    {{-- friends of friends list --}}
                    <div class="col-3">
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

                    {{-- friends suggested list --}}
                    <div class="col-3">
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

                    {{-- cities visited by friends but not user --}}
                    <div class="col-3">
                        <div class="container mt-4">
                            <h2>Cities Suggesteds</h2>
                            <ul class="my-4">

                                @foreach ($citiesVisitedByFriendsButNotUser as $city)
                                    <li class="list-group-item my-2 bg-info rounded-pill py-3">
                                        {{ $city }}
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
