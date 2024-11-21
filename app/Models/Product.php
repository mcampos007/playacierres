<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [ 'name', 'price' ];
    //

    // Relación con el modelo Tanque

    public function tanques() {
        return $this->hasMany( Tanque::class );
    }

    public function surtidores() {
        return $this->hasMany( Surtidor::class );
    }
}
