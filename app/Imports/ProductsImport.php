<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'code' => $row[0],
            'name' => $row[1],
            'quantity_stock' => $row[2],
            'quantity_inventory' => $row[3],
            'due_date' => $row[4],
            'category' => $row[5],
            'description' => $row[6],
            'id_user'=> Auth::id(),
            'min_supply_quantity' => $row[7],
        ]);
    }
}
