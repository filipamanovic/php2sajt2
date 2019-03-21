<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminProductModel;
use App\Models\Admin\AdminUserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $productModel;
    private $userModel;
    public function __construct(){
        $this->productModel = new AdminProductModel();
        $this->userModel = new AdminUserModel();
    }

    public function indexPage(){
        $products = $this->productModel->getAll();
        $users = $this->userModel->getAllForComment();
        $categories = $this->productModel->getAllCategories();
        $manufacturesrs = $this->productModel->getAllManufacturers();
//        dd($products);
        return view('admin.product.index',[
            'products' => $products,
            'users' => $users,
            'categories' => $categories,
            'manufacturers' => $manufacturesrs
        ]);
    }

    public function insert(Request $request){
        $product_name = $request->product_name;
        $product_desc = $request->product_desc;
        $product_price = $request->product_price;
        $product_checked = $request->product_checked;
        $user_id = $request->user_id;
        $category_id = $request->category_id;
        $manufacturer_id = $request->manufacturer_id;
        $product_image = $request->product_image;
        $image1 = $product_image->getClientOriginalName().time();
        $imageName = 'uploads/pictures/'.$image1;
        $product_image->move('uploads/pictures', $image1);
        if($product_image == null){
            session()->put('message', 'No image selected!');
            return redirect()->back();
        }
        $this->productModel->insertProduct($product_name, $product_desc, $product_price, $product_checked, $user_id, $category_id, $manufacturer_id, $imageName);
        session()->put('message', 'Succesfully added product!');
        return redirect()->back();
    }

    public function updatePodaci(Request $request){
        return response()->json($this->productModel->getSingleProduct($request->product_id));
    }

    public function updateProduct(Request $request){
        $product_name = $request->product_name;
        $product_desc = $request->product_desc;
        $product_price = $request->product_price;
        $product_checked = $request->product_checked;
        $user_id = $request->user_id;
        $category_id = $request->category_id;
        $manufacturer_id = $request->manufacturer_id;
        $product_image = $request->product_image;
        $product_id = $request->product_id;
        $slika_id = $request->slika_id;
        if($product_image == null){
            session()->put('message', 'Succesfully updated product!');
            $this->productModel->updateProduct1($product_name, $product_desc, $product_price, $product_checked, $user_id, $category_id, $manufacturer_id, $product_id);
            return redirect()->back();
        }
        $image1 = $product_image->getClientOriginalName().time();
        $imageName = 'uploads/pictures/'.$image1;
        $product_image->move('uploads/pictures', $image1);
        session()->put('message', 'Succesfully updated product!');
        $this->productModel->updateProduct2($product_name, $product_desc, $product_price, $product_checked, $user_id, $category_id, $manufacturer_id, $product_id, $slika_id, $imageName);
        return redirect()->back();
    }

    public function deleteProduct(Request $request){
        $this->productModel->deleteProduct($request->product_id);
        session()->put('message', 'Succesfully deleted product!');
        return response()->json();
    }
}
