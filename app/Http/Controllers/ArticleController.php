<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;


class ArticleController extends Controller
{
    public function indexAll(){
        $articles = Article::with('tags')
            ->orderBy('publish_at', 'desc')
            ->limit(10)
            ->get();

        return view('welcome', compact('articles'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =auth()->user();
        if($user->role === 'admin' ){
            return view('list-article',[
            'articles' => Article::all()
        ]);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-article', ['tags'=>Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $validate = $request->validated();
        $article = new Article;
        $article->title = $validate['title'];
        $article->content = $validate['content'];
        $article->user_id = auth()->user()->id;
        $article->save();
        $article->tags()->attach($request->input('tag'));
        return redirect('/show-article');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();
        /** @var User $user */
        $articles = $user
            ->articles()
            ->with('tags')
            ->orderBy('id', 'desc')
            ->get();
        
            return view('show-article', compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =auth()->user();
        $article = Article::find($id);
        if($user->id === $article->user_id || $user->role === 'admin' ){
            return view ('edit-article', [
            'article' => Article::find($id),
            'tags'=>Tag::all()
        ]);
        }
        else{
            return redirect('/show-article');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $user =auth()->user();
        $request->validated();
        $article = Article::findOrFail($request->id);
        if($user->id === $article->user_id || $user->role === 'admin' ){
            $article->title = $request->title;
            $article->content = $request->content;
            $article->save();
            $article->tags()->sync($request->input('tag'));
            return redirect('/show-article');
        }
        else{
            return redirect('/show-article');
        }
    }

    public function publish_at($id){
        $article = Article::findOrFail($id);
        $article->publish_at = Now();
        $article->save();
        return redirect('/show-article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();
        $article = Article::findOrFail($request->id);
        if($user->id === $article->user_id || $user->role === 'admin' ){
            $article->delete();
            return redirect('/show-article');
        }
        else{
            return redirect('/show-article');
        }
    }
}
