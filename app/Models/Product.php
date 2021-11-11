<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['code','name','quantity_stock','quantity_inventory','due_date','category','importance','description','id_user','min_supply_quantity'];
}
