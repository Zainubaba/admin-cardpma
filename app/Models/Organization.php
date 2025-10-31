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

// accessors for manageOrg

protected $appends = ['district_name', 'tehsil_name', 'edu_level_name', 'hod_name'];

public function getDistrictNameAttribute() {
    return $this->district?->name;
}
public function getTehsilNameAttribute() {
    return $this->tehsil?->tehsil_name;
}
public function getEduLevelNameAttribute() {
    return $this->eduLevel?->name;
}
public function getHodNameAttribute() {
    return $this->hod?->name;
}


}
