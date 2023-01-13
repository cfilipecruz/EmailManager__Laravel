<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Departamento extends Model
{
    protected $table = 'departamento';
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }
}

