<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['type_transaction',
        'description_transaction',
        'id_product',
        'code',
        'name',
        'quantity_stock',
        'quantity_inventory',
        'due_date',
        'category',
        'description',
        'id_user',
        'min_supply_quantity'];
    
}
