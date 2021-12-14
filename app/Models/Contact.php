<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'contact_person_name',
        'person_mobile',
        'person_email',
        'office_addr',
        'company_balance'       
    ];
}
