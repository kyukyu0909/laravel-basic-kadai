<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = DB::table('posts')->get();
        return view('posts.index',compact('posts'));
    }

    public function show($id) {
        // URL'/posts/{id}'の'{id}'部分と主キー（idカラム）の値が一致するデータをpostsテーブルから取得し、変数$postに代入する
        $post = Post::find($id);

        // 変数$productをproducts/show.blade.phpファイルに渡す
        return view('posts.show', compact('post'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
        //バリデーションの設定
        $request->validate([
            'title'=>'required|max:20',
            'content'=>'required|max:200'
        ]);
        //データを追加
        $post=new Post();
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->save();
        //リダイレクト
        return redirect('/posts');
    }
}
