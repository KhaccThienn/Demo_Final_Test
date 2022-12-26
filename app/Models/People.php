<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'province_id', 'avatar',    'birthday',    'gender', 'about'];

    public function provinces()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function scopeSearch($query)
    {
        if (request()->keyword) {
            $key = request()->keyword;
            $query = $query->where('name', 'LIKE', '%'.$key.'%');
        }
        return $query;
    }
}
