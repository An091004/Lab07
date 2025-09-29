<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $id;
    public $title;
    public $content;

    // Mock findOrFail cho demo
    public static function findOrFail($id)
    {
        $mockArticles = [
            1 => ['id' => 1, 'title' => 'Tran Tuan An', 'content' => 'Content for article 1'],
            2 => ['id' => 2, 'title' => 'Ngoc Diep', 'content' => 'Content for article 2'],
            3 => ['id' => 3, 'title' => 'Thanh Hoang', 'content' => 'Content for article 3'],
        ];
        if (isset($mockArticles[$id])) {
            $data = $mockArticles[$id];
            $article = new static();
            $article->id = $data['id'];
            $article->title = $data['title'];
            $article->content = $data['content'];
            return $article;
        }
        abort(404, 'Article not found');
    }

    // Route Model Binding
    public function resolveRouteBinding($value, $field = null)
    {
        return static::findOrFail($value);
    }
}
