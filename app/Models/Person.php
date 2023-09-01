<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    // Nome della tabella associata al modello
    protected $table = 'people';

    // Attributi fillable, cioè quelli che possono essere riempiti con dati in massa
    protected $fillable = [
        'firstName',
        'surname',
        'age',
        'gender'
    ];

    /**
     * Definizione della relazione "uno a molti" tra Persona e Città visitate.
     *
     * Una persona può avere molte città visitate.
     */
    public function citiesVisited()
    {
        return $this->hasMany(City::class, 'person_id');
    }

    /**
     * Definizione della relazione "molti a molti" tra Persone come "amici".
     *
     * Questa relazione rappresenta gli amici di una persona.
     */
    public function friends()
    {
        return $this->belongsToMany(Person::class, 'connections', 'person_id', 'friend_id');
    }

    /**
     * Definizione della relazione "molti a molti" tra Persone come "amicizie".
     *
     * Questa relazione rappresenta le persone che considerano questa persona come loro amico.
     */
    public function friendships()
    {
        return $this->belongsToMany(Person::class, 'connections', 'friend_id', 'person_id');
    }
}
