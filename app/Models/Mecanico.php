<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mecanico extends Model
{

protected $fillable = ['user_id', 'oficina_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function oficina()
{
    return $this->belongsTo(Oficina::class);
}

public function marcacoes()
{
    return $this->hasMany(Marcacao::class);
}
}
