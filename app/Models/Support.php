<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'support_department_id',
        'subject',
        'status',
    ];

    public function support_department(): BelongsTo
    {
        return $this->BelongsTo(SupportDepartment::class);
    }
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function msgs(): HasMany
    {
        return $this->hasMany(Msg::class);
    }

}
