<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminCommentModel;
use App\Models\Admin\AdminProductModel;
use App\Models\Admin\AdminUserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    private $commentModel;
    private $productModel;
    private $userModel;
    public function __construct(){
        $this->commentModel = new AdminCommentModel();
        $this->productModel = new AdminProductModel();
        $this->userModel = new AdminUserModel();
    }

    public function indexPage(){
        $comments = $this->commentModel->getAll();
        $products = $this->productModel->getAllForComment();
        $users = $this->userModel->getAllForComment();
        return view('admin.comment.index',[
            'comments' => $comments,
            'products' => $products,
            'users' => $users
        ]);
    }

    public function insert(Request $request){
        $comment_text = $request->comment_text;
        $product_id = $request->product_id;
        $user_id = $request->user_id;
        $this->commentModel->insert($comment_text, $product_id, $user_id);
        session()->put('message', 'Succesfully inserted comment');
        return redirect()->back();
    }

    public function updatePodaci(Request $request){
        $komentar = $this->commentModel->getSingleComment($request->comment_id);
        return response()->json($komentar);
    }

    public function updateComment(Request $request){
        $text = $request->comment_text;
        $user_id = $request->user_id;
        $product_id = $request->product_id;
        $comment_id = $request->comment_id;
//        $niz = [$text, $user_id, $product_id, $comment_id];
//        return dd($niz);
        $this->commentModel->updateComment($text, $user_id, $product_id, $comment_id);
        session()->put('message', 'Succesfully updated comment');
        return redirect()->back();
    }

    public function deleteComment(Request $request){
//        $comment_id = $request->comment_id;
        $this->commentModel->deleteComment($request->comment_id);
        session()->put('message', 'Succesfully deleted comment');
        return response()->json();
    }


}
