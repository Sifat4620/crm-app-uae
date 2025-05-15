<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guerded = [];

    /**
     * Gets the user of current client
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Client>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
