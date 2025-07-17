<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcacao extends Model
{
    public function cliente()
{
    return $this->belongsTo(Cliente::class);
}

public function mecanico()
{
    return $this->belongsTo(Mecanico::class);
}

public function oficina()
{
    return $this->belongsTo(Oficina::class);
}
}
