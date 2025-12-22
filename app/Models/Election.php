<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'is_open'];
    public function candidates() { return $this->hasMany(Candidate::class); }
}
