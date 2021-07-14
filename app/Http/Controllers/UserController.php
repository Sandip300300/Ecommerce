<?php

namespace App\Http\Controllers;
use App\Models\User;
//use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users=User::get();
        return view('admin.user.index',compact('users'));
    }
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return back()->with('delete','User has been deleted');
    }
}
