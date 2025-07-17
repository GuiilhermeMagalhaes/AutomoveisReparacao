<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function oficina()
{
    return $this->belongsTo(Oficina::class);
}
}
