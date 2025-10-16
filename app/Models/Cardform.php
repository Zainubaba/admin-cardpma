<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardform extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'form_id','category', 'near_station',
    'pickup_station',
    'to_route1',
    'from_route1',
    'to_route2',
    'from_route2',
    'to_route3',
    'from_route3',
    'name','card_name','cnic','cnic_expiry_date', 'phone_number', 'org_name',
    'faddress',
    'gender',
    'dob',
    'photo',
    'cnic_front',
    'cnic_back',
    'student_id_card_front',
    'student_id_card_back',
    'empolyee_card',
    'disability_certificate',
    'pcrdp',
    'student_affidavite',
    'empolyee_affidavite',
    'verify_form',
    'remarks', 

'cardnumber','cardissuedate',
'dispatch',
't_c','verify_payment'
];
    
}
