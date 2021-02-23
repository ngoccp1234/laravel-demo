<?php

namespace App\Http\Controllers;

use App\Enums\CommonStatus;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /*
     @param*/
    public function create(ProductRequest $req)
    {
        $product = new Product();
        $product->fill($req->all());
        $product->save();
        return $req->validated();
    }

    public function getList(Request $req)
    {
        $keyword = $req->query('search');
        $status = $req->query('status');

//        $queryBuilder = Product::query()->where('status', '=', CommonStatus::ACTIVE);
        $queryBuilder = Product::query();

        if ($keyword) {
            $queryBuilder = $queryBuilder
                ->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
        }
        return $queryBuilder->get();
    }

    public function single($id)
    {
        return DB::table('products')->where('id', $id)->get();
    }

    public function update(ProductRequest $req, $id)
    {
//        $product = new Product();
//        $product->fill($req->all());
//        $productUpdate = DB::table('products')->where('id', $id)->update(['name'=> $req->input('name'),
//            'price'=> $req->input('price'),
//            'description'=> $req->input('description'),
//            'quantity'=> $req->input('quantity'),
//            ]);
        $productUpdate = DB::table('products')->where('id', $id)->update($req->all());
        return $req->validated();
    }

    public function delete($id)
    {
        $deleteProduct = DB::table('products')->where('id', $id)->delete();
        return "delete successfully";
    }
}
