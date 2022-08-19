<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  CPU extends Model
{
    use HasFactory;
    public $fillable = ['ID', 'CPU'];
    protected $table = 'cpu';
}
