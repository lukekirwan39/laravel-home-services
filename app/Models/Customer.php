<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // You can define fillable or guarded properties here
    protected $fillable = [
        'user_id',  // Ensure that the customer has a user_id linked to the User model
    ];

    // You may define relationships if needed (for example, a Customer belongs to a User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
