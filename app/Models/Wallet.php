<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['name', 'balance', 'user_id'];

    protected $table = 'wallets';

    public function transactions()
{
    return $this->hasMany(Transaction::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
