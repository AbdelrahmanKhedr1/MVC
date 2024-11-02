<?php

namespace App\Http\Controllers;

use App\Models\User;
use Iliuminates\Database\Model;
use Iliuminates\Http\Request;
use Iliuminates\Http\Validations\Validation;
use Iliuminates\Views\View;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::paginate(1);
        // echo "<pre>";
        // var_dump($users->getData());
        // echo "<hr>";
       
        // echo "<hr>";
        // echo "<br>";

        

        return view('index',['users'=>$users]);

        // return $users = User::where('name','admin')->count();
        // $users = User::offset(1)->limit(1)->get()->toArray();
        // // $users = User::where('name','admin')->get();
        // // $users = User::get();
        // foreach($users as $user){
        //     echo $user['name']."<br>";
        // }

        // $user = User::where('name','=','admin')->first();
        // return $user->email;

        // $user = User::find(18)->toArray(); 
        // return $user['name'];

        // $user = new User();
        // // $user->name = 'John Doe';
        // echo $user->name;

        // var_dump(request());
        // exit;
        // $validation = $this->validate([
        //     'user_id' => 1,
        //     'name' => 'assd',
        //     'age' => 'dksfn',
        //     'email' => 'dksfn',
        // ], [
        //     'user_id' => ['required', 'integer', 'unique:users,id'],
        //     'name' => ['required', 'string', 'in:ahmed,omar'],
        //     'age' => ['required', 'integer'],
        //     'email' => ['required', 'email'],
        // ], [
        //     'user_id' => trans('main.user_id'),
        //     'name' => trans('main.name'),
        //     'age' => trans('main.age'),
        //     'email' => trans('main.email'),
        // ]);
        // echo "<pre>";
        // var_dump($validation->validated());
        // return var_dump($validation->failed());
        // return View::make('index',['title'=>'index title','content'=>'test contant']) ;
        // return view('index',['title'=>'index title','content'=>'test contant']) ;
    }

    public function data()
    {
        return view('data');
    }
    public function data_post()
    {
        echo "<pre>";

        return var_dump(request());

        // var_dump(request()->file('file'));

        // $file = request()->file('file');
        // $file->name(uniqid('',true).rand(0000,9999).time());
        // return $file->store('image');
        // echo "<pre>";
        // var_dump(Request::file('file'));
        // return Request::file('file')->store('data');
    }
    public function about()
    {
        echo "hello fom about";
    }
    public function api_any()
    {
        return "hello fom api any page";
    }

    public function article($id)
    {
        echo "hello fom article id = " . $id;
    }
}
