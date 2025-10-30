<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
      protected $guarded = [];
    protected $table = 'organizations';

    
public function district() {
    return $this->belongsTo(District::class);
}

public function tehsil() {
    return $this->belongsTo(Tehsil::class);
}
public function eduLevel()
{
    return $this->belongsTo(Edu::class, 'edu_level');
}
public function hod() {
    return $this->belongsTo(Hod::class);
}

}
