<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Nome della tabella associata al modello
    protected $table = 'cities_visited';

    // Attributi fillable, cioè quelli che possono essere riempiti con dati in massa
    protected $fillable = [
        'person_id',
        'city_name',
        'rating_percent'
    ];

    // Relazione con il modello Person (una visita in città appartiene a una persona)
    public function person() {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
