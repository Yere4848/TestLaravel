<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutingModel extends Model
{
    use HasFactory;

    public $table = "routings";

    protected $fillable = [
        'routingID', 'proses1', 'proses2'
    ];
}
