<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model {
    // Tabla asociada al modelo
    protected $table = 'turnos';

    // Campos que pueden ser llenados de forma masiva
    protected $fillable = [
        'turno',
        'fecha',
        'user_id',
        'efectivo',
        'ctacte',
        'visa',
        'electron',
        'maestro',
        'mastercard',
        'american',
        'cheques',
        'otros',
        'status',
    ];
    //

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function turnoDetails() {
        return $this->hasMany( TurnoDetail::class );
    }

}
