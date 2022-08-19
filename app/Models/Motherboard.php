<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motherboard extends Model
{
    use HasFactory;
    public $fillable = ['ID', 'Motherboard'];
    protected $table = 'motherboard';
}
