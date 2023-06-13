<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'status'
    ];

    /**
     * The attributes that should be cast
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean'
    ];
}
