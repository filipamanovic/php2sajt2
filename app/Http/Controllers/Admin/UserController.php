<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminRoleModel;
use App\Models\Admin\AdminUserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userModel;
    private $roleModel;
    public function __construct(){
        $this->userModel = new AdminUserModel();
        $this->roleModel = new AdminRoleModel();
    }

    public function index()
    {
        $roles = $this->roleModel->getAll();
        $users = $this->userModel->getAll();
        return view('admin.user.index',[
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function updateUser(Request $request){
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $tel = $request->tel;
        $city = $request->city;
        $role_id = $request->role_id;
        $aktivan = $request->aktivan;
        $pass = $request->password;
        $user_id = $request->user_id;
        if(strlen($pass) == 32){
            $pass = 'zika';
            $this->userModel->updateUser($first_name, $last_name, $email,$pass, $tel, $city, $aktivan, $role_id, $user_id);
            session()->put('message', 'Succesfully updated user!');
            return redirect()->back();
        } else {
            $this->userModel->updateUser($first_name, $last_name, $email, $pass, $tel, $city, $aktivan, $role_id, $user_id);
            session()->put('message', 'Succesfully updated user!');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $pass = $request->password;
        $email = $request->email;
        $tel = $request->tel;
        $city = $request->city;
        $role_id = $request->role_id;
        $aktivan = $request->aktivan;
        try{
            $this->userModel->addUser($first_name, $last_name, $email, $pass, $tel, $city, $aktivan, $role_id);
            session()->put('message', 'Succesfully inserted user!');
            return redirect()->back();
        }catch (\Exception $e){
            Log::critical("Greska adminInsert user");
            session()->put('message', 'Greska adminInsert user');
            return redirect()->back();
        }
    }


    public function updatePodaci(Request $request){
        $user = $this->userModel->getSingleUser($request->userId);
        return response()->json($user);
    }


    public function deleteUser(Request $request){
        $this->userModel->deleteUser($request->user_id);
        session()->put('message', 'Succesfully deleted user!');
        return redirect()->back();
    }
}
