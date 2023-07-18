<?php

namespace App\Imports;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToCollection, WithBatchInserts, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $value)
        {
            if($value[1] != null) {
                $product = Product::where('title', $value[0])->first();
                if($product) {
                    $product->univers_id = $value[2];
                    $product->description = $value[3];
                    $product->tags = strtoupper($value[4]);
                    $product->labels = $value[5];
                    $product->active = 1;
                    $product->update();
                } else {
                    $pro = new Product;
                    $pro->title = $value[0];
                    $pro->picture = $value[1];
                    $pro->univers_id = $value[2];
                    $pro->description = $value[3];
                    $pro->tags = strtoupper($value[4]);
                    $pro->labels = $value[5];
                    $pro->active = 1;
                    $pro->save();
                }
            }
        }
    }

    public function batchSize(): int
    {
        return 200;
    }

    public function startRow(): int
    {
        return 2;
    }
}
