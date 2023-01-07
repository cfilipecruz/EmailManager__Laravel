<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{

    use HasFactory;

    public function departamento(){

        return $this->belongsTo(Departamento::class);

    }
    public function funcionario(){

        return $this->belongsTo(User::class);

    }
    public function estado(){

        return $this->belongsTo(Estado::class);

    }
}
