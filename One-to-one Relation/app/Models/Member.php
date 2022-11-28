<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'username',
        'nama',
        'status',
    ];

    public function sosmed(){
        return $this->hasOne('App\Models\Sosmed');
    }
}
