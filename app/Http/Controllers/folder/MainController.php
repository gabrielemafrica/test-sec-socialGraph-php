<?php

namespace App\Http\Controllers\folder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Person;
use App\Models\Connection;
use App\Models\City;

class MainController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return view("people.index", compact('people'));
    }

    public function show($id)
    {
        $person = Person::find($id);

        // Trova gli amici dell'utente
        $friends = $person->friends;

        // Trova le amicizie dell'utente
        $friendship = $person->friendships;

        // Trova gli amici degli amici
        $friendOfFriend = Person::select('people.id', 'people.firstName', 'people.surname', 'people.gender')
            ->join('connections AS C1', 'people.id', '=', 'C1.person_id')
            ->join('connections AS C2', 'C1.friend_id', '=', 'C2.person_id')
            ->where('C2.friend_id', $id)
            ->where('people.id', '<>', $id)
            ->whereNotIn('people.id', function ($query) use ($id) {
                $query->select('friend_id')
                    ->from('connections')
                    ->where('person_id', $id);
            })
            ->distinct()
            ->get();

        // Trova gli amici consigliati
        $friendsSuggested = Person::select('people.id', 'people.firstName', 'people.surname', 'people.gender')
            ->join('connections AS C1', 'people.id', '=', 'C1.person_id')
            ->join('connections AS C2', 'C1.friend_id', '=', 'C2.person_id')
            ->where('C2.friend_id', $id)
            ->where('people.id', '<>', $id)
            ->whereNotIn('people.id', function ($query) use ($id) {
                $query->select('friend_id')
                    ->from('connections')
                    ->where('person_id', $id);
            })
            ->whereNotIn('people.id', function ($query) use ($id) {
                $query->select('friend_id')
                    ->from('connections')
                    ->where('person_id', $id);
            })
            ->whereIn('people.id', function ($subquery) use ($id) {
                $subquery->select('C3.person_id')
                    ->from('connections AS C3')
                    ->whereIn('C3.friend_id', function ($innerSubquery) use ($id) {
                        $innerSubquery->select('C4.friend_id')
                            ->from('connections AS C4')
                            ->where('C4.person_id', $id);
                    })
                    ->groupBy('C3.person_id')
                    ->havingRaw('COUNT(C3.friend_id) >= 2');
            })
            ->distinct()
            ->get();

        // Trova gli ID degli amici dell'utente
        $friendIds = Connection::where('person_id', $id)->pluck('friend_id')->toArray();

        // Trova le città visitate dagli amici, ordinate per rating decrescente
        $citiesVisitedByFriends = City::whereIn('person_id', $friendIds)
            ->orderByDesc('rating')
            ->pluck('city_name')
            ->unique()
            ->toArray();

        // Trova le città visitate dall'utente
        $citiesVisitedByUser = City::where('person_id', $id)
            ->pluck('city_name')
            ->toArray();

        // Rimuovi le città visitate dall'utente stesso dall'elenco delle città visitate dagli amici
        $citiesVisitedByFriendsButNotUser = array_diff($citiesVisitedByFriends, $citiesVisitedByUser);

        return view("people.show", compact('person', 'friends', 'friendOfFriend', 'friendsSuggested', 'citiesVisitedByFriendsButNotUser'));
    }
}
