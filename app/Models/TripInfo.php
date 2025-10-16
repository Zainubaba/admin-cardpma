<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripInfo extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'trip_infos';
}
