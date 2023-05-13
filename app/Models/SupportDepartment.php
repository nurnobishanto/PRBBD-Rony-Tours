<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportDepartment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
    ];

    public function supports(): HasMany
    {
        return $this->hasMany(Support::class);
    }
}