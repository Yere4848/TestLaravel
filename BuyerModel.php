<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerModel extends Model
{
    use HasFactory;

    public $table = "buyers";

    protected $fillable = [
        'buyerID', 'buyerName'
    ];

    //protected $primaryKey = 'buyerID';
    // public $primaryKey = 'buyerID';
}
