<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanque extends Model {
    //
    protected $table = 'tanques';

    protected $fillable = [
        'nombre', 'capacidad', 'product_id'
    ];

    // Relación con el modelo Product

    public function product() {
        return $this->belongsTo( Product::class );
    }

    // Relación con el modelo Surtidor

    public function surtidors() {
        return $this->hasMany( Surtidor::class );
    }
}
