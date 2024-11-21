<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surtidor extends Model {
    protected $table = 'surtidors';

    protected $fillable = [
        'name', 'product_id', 'lectura_actual', 'tanque_id'
    ];

    // Relación con el modelo Tanque

    public function tanque() {
        return $this->belongsTo( Tanque::class );
    }

    public function product() {
        return $this->belongsTo( Product::class );
    }

    public function turnoDetails() {
        return $this->hasMany( TurnoDetail::class );
    }
}
