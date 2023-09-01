<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    // Nome della tabella associata al modello
    protected $table = 'connections';

    // Attributi fillable, cioè quelli che possono essere riempiti con dati in massa
    protected $fillable = [
        'person_id',
        'friend_id'
    ];
}
