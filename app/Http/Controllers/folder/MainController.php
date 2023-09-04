<?php

namespace App\Http\Controllers\folder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Person;
use App\Models\Connection;
use App\Models\City;

class MainController extends Controller
{
    public function index() {
        $people = Person :: all();
        // dd($people);
        return view("people.index", compact('people'));
    }
    public function show($id) {
        $person = Person :: find($id);

        //friends
        $friends = $person->friends;

        //friendships
        $friendship = $person->friendships;

        // Trova gli amici degli amici
        $friendOfFriend =  Person::select('people.id', 'people.firstName', 'people.surname', 'people.gender')
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

            //query corretta SQL
        // SELECT DISTINCT
        // P.id AS fof_id,
        // P.firstName AS fof_firstName,
        // P.surname AS fof_surname
        // FROM people AS P
        // JOIN connections AS C1 ON P.id = C1.person_id
        // JOIN connections AS C2 ON C1.friend_id = C2.person_id
        // WHERE C2.friend_id = 1
        // AND P.id <> 1
        // AND P.id NOT IN (
        //     SELECT friend_id FROM connections WHERE person_id = 1
        // );

        //CONSIGLIATI
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



        // SQL
        // SELECT DISTINCT
        // P.id,
        // P.firstName,
        // P.surname
        // FROM people AS P
        // JOIN connections AS C1 ON P.id = C1.person_id
        // JOIN connections AS C2 ON C1.friend_id = C2.person_id
        // WHERE C2.friend_id = 20
        // AND P.id <> 20
        // AND P.id NOT IN (
        // SELECT friend_id FROM connections WHERE person_id = 20
        // )
        // AND P.id NOT IN (
        // SELECT friend_id FROM connections WHERE person_id = 20
        // )
        // AND P.id IN (
        // SELECT C3.person_id
        // FROM connections AS C3
        // WHERE C3.friend_id IN (
        //     SELECT C4.friend_id
        //     FROM connections AS C4
        //     WHERE C4.person_id = 20
        // )
        // GROUP BY C3.person_id
        // HAVING COUNT(C3.friend_id) >= 2
        // );


        return view("people.show", compact('person', 'friends', 'friendOfFriend', 'friendsSuggested'));
    }
}
