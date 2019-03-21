<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\SearchModel;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Int_;

class IndexController extends Controller
{
    private $searchModel;
    private $productModel;

    public function __construct(){
        $this->searchModel = new SearchModel();
        $this->productModel = new ProductModel();
    }


    public function indexPage(){
        $categories = $this->searchModel->getAllCategories();
        $manufacturers = $this->searchModel->getAllManufacturers();
        $products = $this->productModel->getAllProducts();
        return view('front.pages.index',
            [
                'categories' => $categories,
                'manufacturers' => $manufacturers,
                'products' => $products
            ]
        );
    }

    public function sortProduct(Request $request){
        $categories = $this->searchModel->getAllCategories();
        $manufacturers = $this->searchModel->getAllManufacturers();

        if(isset($request->category_id) || isset($request->manufacturer_id) || isset($request->price_min) || isset($request->price_max)){
            session()->forget('category');
            session()->forget('manufacturer');
            session()->forget('price_min');
            session()->forget('price_max');
            $category_id = $request->category_id;
            $manufacturer_id = $request->manufacturer_id;
            $price_min = $request->price_min;
            $price_max = $request->price_max;
            session()->put('category', $category_id);
            session()->put('manufacturer', $manufacturer_id);
            session()->put('price_min', $price_min);
            session()->put('price_max', $price_max);
        }

        $price_min = (int)session()->get('price_min');
        $price_max = (int)session()->get('price_max');
        $category_id = session()->get('category');
        $manufacturer_id = session()->get('manufacturer');

        if($price_min == null){
            $price_min = 0;
        }
        if($price_max == null){
            $price_max = 999999;
        }
//        $niz = [$price_min, $price_max, $manufacturer_id, $category_id];
//        return dd($niz);
        $products = $this->productModel->sortProduct($category_id, $manufacturer_id, $price_min, $price_max);
//        return dd($products);
        if(count($products) == 0){
            session()->put('noUser', 'Currently there is no item for your search');
        }
        return view('front.pages.index', [
            'categories' => $categories,
            'manufacturers' => $manufacturers,
            'products' => $products
        ]);
    }
}
