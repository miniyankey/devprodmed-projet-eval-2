<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserAnswer;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
   public function answers(): HasMany
    {
        return $this->hasMany(UserAnswer::class);
    }
}
