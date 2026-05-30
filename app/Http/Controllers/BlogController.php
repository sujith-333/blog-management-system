<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs      = Blog::with('category')->latest()->get();
        $categories = Category::all();
        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function show($id)
    {
        $blog       = Blog::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('blogs.show', compact('blog', 'categories'));
    }

    public function filter(Request $request)
    {
        $query = Blog::with('category');

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('short_description', 'like', '%' . $request->search . '%');
            });
        }

        $blogs = $query->latest()->get();
        return view('blogs.partials.blog-list', compact('blogs'));
    }
}