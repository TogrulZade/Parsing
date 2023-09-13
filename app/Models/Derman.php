<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Derman extends Model
{
    use HasFactory;

    protected $table = 'derman';

    /**
     * Get all of the site for the Derman
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function site()
    {
        return $this->hasMany(Site::class, 'id', 'site');
    }
}
