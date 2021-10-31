<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
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
        
        $categories = Category::all();
        foreach($categories as $cate){
            if($row[5] == $cate->name){
                $rowconvert = $cate->id;
            }
        }
        return new Product([
            'code' => $row[0],
            'name' => $row[1],
            'quantity_stock' => $row[2],
            'quantity_inventory' => $row[3],
            'due_date' => $row[4],
            'category' => $rowconvert,
            'description' => $row[6],
            'id_user'=> Auth::id(),
            'min_supply_quantity' => $row[7],
        ]);
    }
}
