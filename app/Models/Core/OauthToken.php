<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OauthToken extends Model
{
    use HasFactory;
	protected $guarded = [];
    protected $connection = 'pgsql';

    public function hasExpired()
    {
        return now()->gte($this->updated_at->addSeconds($this->expires_in));
    }
}
