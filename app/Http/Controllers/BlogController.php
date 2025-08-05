<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\tag;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $selectedTag = $request->query('tag');

        $blogsQuery = Blog::latest();

        if ($selectedTag) {
            $blogsQuery->whereHas('tag', function ($query) use ($selectedTag) {
                $query->where('name', $selectedTag);
            });
        }

        $blogs = $blogsQuery->paginate(6)->withQueryString();
        $tags = Tag::all();

        return view('posts.blog', compact('blogs', 'tags', 'selectedTag',));
    }
    public function userindex(Request $request)
    {
        $selectedTag = $request->query('tag');


        $userblogs = Auth::user()->blogs()->orderBy('created_at', 'desc');


        if ($selectedTag) {
            $userblogs->whereHas('tag', function ($query) use ($selectedTag) {
                $query->where('name', $selectedTag);
            });
        }

        $blogs = $userblogs->paginate(6)->withQueryString();
        $tags = Tag::all();

        return view('posts.userblog', compact('blogs', 'tags', 'selectedTag'));
    }
    public function show(Blog $blog)
    { {
            $blog->load(['comments.user', 'tags']); // load comments and authors
            return view('posts.show', compact('blog'));
        }
    }
    public function create(Blog $blog)
    {

        if (!Auth::user()) {
            return redirect('/login');
        }
        $tags = Tag::all();

        return view('posts.create', ['blog' => $blog, 'tags' => $tags]);
    }
    public function store(Blog $blog)
    {
        $validate = request()->validate([
            'Author' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id', // validate each tag ID
        ]);

        $validate['user_id'] = Auth::id();

        if (request()->hasFile('image')) {
            $validate['image'] = request()->file('image')->store('blog_images', 'public');
        }

        // Create blog post
        $newBlog = Blog::create($validate);

        // Attach selected tags
        if (request()->has('tags')) {
            $newBlog->tags()->sync(request('tags')); // attach selected tag IDs
        }

        return redirect('/blogs');
    }
    public function edit(Blog $blog)
    {
        $alltags = Tag::all();
        $selectedTagIds = $blog->tags->pluck('id')->toArray();

        return view('posts.edit', ['blog' => $blog, 'allTags' => $alltags, 'selectedTagIds' => $selectedTagIds]);
    }
    public function update(Blog $blog)
    {
        $validate = request()->validate([
            'Author' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:5120',
            'existing_tags' => 'nullable|array',
            'existing_tags.*' => 'exists:tags,id',
        ]);
           $blog->tags()->sync($validate['existing_tags'] ?? []);

        if (request()->hasfile('image')) {
            $validate['image'] = request()->file('image')->store('blog_images', 'public');
        }
        $blog->update($validate);
        return redirect('/blogs');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect('/blogs');
    }
}
