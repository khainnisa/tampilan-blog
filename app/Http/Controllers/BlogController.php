<?php

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $categoryFilter = $request->query('category');
        $searchKeyword = $request->query('search');
        
        if ($searchKeyword && $categoryFilter) {
            $categoryId = Category::where('slug', $categoryFilter)->first()->id;
            $blogs = Blog::where('category_id', $categoryId)
                ->where('title', 'like', "%$searchKeyword%")
                ->get();
        } else if ($searchKeyword) {
            $blogs = Blog::where('title', 'like', "%$searchKeyword%")->get();
        }else if ($categoryFilter) {
            $categoryId = Category::where('slug', $categoryFilter)->first()->id;
            $blogs = Blog::where('category_id', $categoryId)->get();
        } else {
            $blogs = Blog::all();
        }
        
        $categories = Category::all();
        view('blogs.index', compact('blogs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all;
        view('blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Blog::createUniqueSlug($request->title);
        $blog->content = $request->content;
        $blog->category_id = $request->category;
        $blog->save();

        redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::where('slug', $id)->first();
        redirect('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::where('slug', $id)->first();
        $categories = Category::all();
        view('blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        $blog = Blog::where('slug', $id)->first();
        $blog->title = $request->title;
        $blog->slug = Blog::createUniqueSlug($request->title);
        $blog->content = $request->content;
        $blog->category_id = $request->category;
        $blog->save();

        redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::where('slug', $id)->first();
        $blog->delete();
        redirect()->route('blogs.index');
    }
}
