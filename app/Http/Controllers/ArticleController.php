<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;


use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function store(StoreArticleRequest $request)
    {
        $this->authorize('create', Article::class);
        $data = $request->validated();
        // Xử lý ảnh (nếu có)
        if ($request->hasFile('image')) {
            // Lưu vào disk 'public' (đường dẫn: storage/app/public/articles/...)
            $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path; // lưu đường dẫn tương đối
        }
        Article::create($data);
        return redirect()->route('articles.index')
            ->with('success', 'Tạo bài viết thành công');
    }
    public function index()
    {
        // Demo: lấy danh sách mock Article instances
        $articles = Article::getMockList();
        return view('articles.index', compact('articles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }
    /**
     * Store a newly created resource in storage.
     **/
    /**
     * Display the specified resource using Route Model Binding (implicit).
     */
    public function show(\App\Models\Article $article)
    {
        // $article là object Article, mock dữ liệu đã có trong model
        return view('articles.show', ['article' => $article]);
    }
    /**

     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            // Xoá ảnh cũ (nếu có)
            if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {

                Storage::disk('public')->delete($article->image_path);
            }
            $data['image_path'] = $request->file('image')->store(
                'articles',
                'public'
            );
        }
        $article->update($data);
        return redirect()->route('articles.show', $article)
            ->with('success', 'Cập nhật bài viết thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        // demo: not actually deleting persistent data
        return redirect()->route('articles.index')
            ->with('success', "Đã xoá bài viết #{$article->id} (demo).");
    }
}
