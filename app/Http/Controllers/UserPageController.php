<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductInsertRequest;
use App\Models\ProductModel;
use App\Models\SearchModel;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    private $productModel;
    private $searchModel;
    public function __construct(){
        $this->productModel = new ProductModel();
        $this->searchModel = new SearchModel();
    }

    public function index($user){
        $userProducts = $this->productModel->getUserProducts($user);
        $noProductMsg = "";
        $categories = $this->searchModel->getAllCategories();
        $manufacturers = $this->searchModel->getAllManufacturers();
        if(count($userProducts) == 0){
            session()->put('noUser', 'Currently you do not have any advertisement, so add new one!');
        }
        return view('front.pages.user', [
            'userProducts' => $userProducts,
            'noProductMsg' => $noProductMsg,
            'categories' => $categories,
            'manufacturers' => $manufacturers
        ]);
    }

    public function insertProduct(ProductInsertRequest $request){
        $productName = $request->productName;
        $productDesc = $request->productDesc;
        $productPrice = $request->productPrice;
        $productImage = $request->file('productImage');
        $user_id = session()->get('user')->id;
        $productCategory = $request->productCategory;
        $productManufacturer = $request->productManufacturer;
//        $niz = [$productName, $productDesc, $productPrice, $productCategory, $productManufacturer];
        $image1 = $productImage->getClientOriginalName().time();
        $imageName = 'uploads/pictures/'.$image1;
        $productImage->move('uploads/pictures', $image1);
        try{
            $this->productModel->insert($productName, $productDesc, $productPrice, $user_id, $productCategory, $productManufacturer, $imageName);
            session()->put('noUser', 'Succesfully inserted product!');
            return redirect()->back()->with(['insSucc' => 'Succesfully inserted product!']);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getUpdateInfo(Request $request){
        return response()->json($this->productModel->getSingleProduct($request->product_id));
    }

    public function productUpdate(ProductInsertRequest $request){
        $slika = $request->file('productImage');
        if($slika != null){
            $image1 = $slika->getClientOriginalName().time();
            $imageName = 'uploads/pictures/'.$image1;
            $slika->move('uploads/pictures', $image1);
            $this->productModel->updateProductSlika($request->productName, $request->productDesc, $request->productPrice, $request->proizvodId, $request->imageId, $imageName);
            session()->put('noUser', 'Succesfullty updated product');
            return redirect()->back();
        }
        $this->productModel->updateProduct($request->productName, $request->productDesc, $request->productPrice, $request->proizvodId);
        session()->put('noUser', 'Succesfullty updated product');
        return redirect()->back();
    }

    public function productDelete(Request $request){
        try {
            $this->productModel->deleteProduct($request->product_id);
            session()->put('noUser', 'Succesfully deleted product!');
            return response()->json('Product deleted');
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
