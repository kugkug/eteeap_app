<?php

declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Timeline extends Model
{
    protected $guarded = ['id'];

    public function sender(): HasOne {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function recipient(): HasOne {
        return $this->hasOne(User::class, 'id', 'recipient_id');
    }
}