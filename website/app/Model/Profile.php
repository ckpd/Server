<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    //
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'street',
        'parish',
        'mobile',
        'landline',
        'farm_name',
        'farm_address_steet',
        'farm_address_parish',
        'flock_capacity',
        'principal_occupation',
        'qualifications',
        'training',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
