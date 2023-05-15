<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Msg extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender',
        'support_id',
        'body'
        ];

    public function support(){
        return $this->belongsTo(Support::class);
    }

}
