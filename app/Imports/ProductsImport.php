<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {
            $categories = Category::all();
            foreach ($categories as $cate) {
                if ($row[5] === $cate->name) {
                    $rowconvert = $cate->id;
                }
            }
            Product::updateOrCreate(
                [
                    'code' => $row[0],
                    'name' => $row[1]
                ],
                [
                    'quantity_stock' => $row[2],
                    'quantity_inventory' => $row[3],
                    'due_date' => $row[4],
                    'category' => $rowconvert,
                    'importance' => $row[6],
                    'description' => $row[7],
                    'id_user' => Auth::id(),
                    'min_supply_quantity' => $row[8],
                ]
            );
        }
    }
}
