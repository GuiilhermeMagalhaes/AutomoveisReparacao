<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    public function gestores()
{
    return $this->hasMany(Gestor::class);
}

public function mecanicos()
{
    return $this->hasMany(Mecanico::class);
}

public function marcacoes()
{
    return $this->hasMany(Marcacao::class);
}
}
