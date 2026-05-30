<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->get();
        return view('admin.dashboard', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required',
            'short_description' => 'required',
            'content'           => 'required',
            'category_id'       => 'required',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Blog::create([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'content'           => $request->content,
            'category_id'       => $request->category_id,
            'image'             => $imageName,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Blog created successfully');
    }

    public function edit($id)
    {
        $blog       = Blog::findOrFail($id);
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'             => 'required',
            'short_description' => 'required',
            'content'           => 'required',
            'category_id'       => 'required',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        $imageName = $blog->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image && file_exists(public_path('images/' . $blog->image))) {
                unlink(public_path('images/' . $blog->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $blog->update([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'content'           => $request->content,
            'category_id'       => $request->category_id,
            'image'             => $imageName,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && file_exists(public_path('images/' . $blog->image))) {
            unlink(public_path('images/' . $blog->image));
        }

        $blog->delete();

        return redirect('/admin/dashboard')->with('success', 'Blog deleted successfully');
    }
    public function uploadImage(Request $request)
{
    if ($request->hasFile('file')) {
        $file     = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        return response()->json(['location' => asset('images/' . $filename)]);
    }
    return response()->json(['error' => 'Upload failed'], 400);
}
}