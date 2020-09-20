<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ico extends Model 
{
    use HasFactory;

    protected $fillable=['ares_firma_fin','ares_ulice_fin','ares_mesto_fin','ares_psc_fin', 'ares_dic_fin'];


}
