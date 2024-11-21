<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurnoDetail extends Model {
    //

    public function turno() {
        return $this->belongsTo( Turno::class );
    }

    public function surtidor() {
        return $this->belongsTo( Surtidor::class );
    }

    // Define el atributo calculado 'importe'

    public function getImporteAttribute() {
        return ( $this->lectura_final - $this->lectura_inicial ) * $this->price;
    }
}
