<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function people()
    {
        return $this->hasMany(People::class, 'province_id', 'id');
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
