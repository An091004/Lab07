<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Article extends Model
{
    use HasFactory;

    // Mock properties (demo)
    public $id;
    public $title;
    public $content;
    public $user_id;
    public $image_path;

    // Mock findOrFail cho demo
    public static function findOrFail($id)
    {
        $mockArticles = [
            1 => ['id' => 1, 'title' => 'Tran Tuan An', 'content' => 'Content for article 1', 'user_id' => 1],
            2 => ['id' => 2, 'title' => 'Ngoc Diep', 'content' => 'Content for article 2', 'user_id' => 2],
            3 => ['id' => 3, 'title' => 'Thanh Hoang', 'content' => 'Content for article 3', 'user_id' => 1],
        ];
        if (isset($mockArticles[$id])) {
            $data = $mockArticles[$id];
            $article = new static();
            $article->id = $data['id'];
            $article->title = $data['title'];
            $article->content = $data['content'];
            $article->user_id = $data['user_id'] ?? null;
            return $article;
        }
        abort(404, 'Article not found');
    }

    /** Return all mock articles as array of Article instances (demo) */
    public static function getMockList()
    {
        $items = [];
        foreach ([1,2,3] as $id) {
            $items[] = static::findOrFail($id);
        }
        return $items;
    }

    // Route Model Binding
    public function resolveRouteBinding($value, $field = null)
    {
        return static::findOrFail($value);
    }
}
