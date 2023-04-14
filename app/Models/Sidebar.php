<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    use HasFactory;
    public $table = "sidebar";
    protected $fillable = [
        'header',
        'item',
        'sort_order',
    ];
}
