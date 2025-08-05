<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }
        $users = User::paginate(5); // 10 users per page

        // Or with additional conditions:



        $totalblog = Blog::count();
        $totaluser = User::count();
        $getTag = Tag::get();
        $getposttag = Blog::has('tags')->count();


        return view("admin.dashboard", compact("totalblog", "getTag", 'getposttag', 'totaluser', 'users'));
    }
    public function createtags()
    {
        $creatTag = request()->validate([
            'name' => ['required'],
            'description' => ['required'],
        ]);

        tag::create($creatTag);
        return redirect('/admin');
    }

    public function update(tag $tag)
    {
        $tag->name = request()->name;
        $tag->description = request()->description;
        $tag->save();

        return response()->json(['message' => 'Tag updated successfully']);
    }
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect('/admin');
    }
    public function userdelete(User $user){
        $user->delete();
        return redirect('admin');
    }
}
