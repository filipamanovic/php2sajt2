<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    private $productModel;
    private $commentModel;

    public function __construct(){
        $this->productModel = new ProductModel();
        $this->commentModel = new CommentModel();
    }

    public function productInfo($id){
        $product = $this->productModel->getSingleProduct($id);
        $comments = $this->commentModel->getAllCommentsForProduct($id);
        return view('front.pages.productPage',[
            'product' => $product,
            'comments' => $comments
        ]);
    }

    public function updateViews(Request $request){
        $this->productModel->updateViews($request->id);
    }

    public function insertComment(Request $request){
        $this->commentModel->insertComment($request->comment, $request->user_id, $request->product_id);
        session()->put('noUser', 'Succesfully added comment');
        return redirect()->back();
    }
}
