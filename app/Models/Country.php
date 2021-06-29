<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'Code'; // говорим, что ID - это Code
    public $incrementing = false; // ID не инкрементируется
    protected $keyType = 'string'; // ID - не число, а строка
    use HasFactory;
}
