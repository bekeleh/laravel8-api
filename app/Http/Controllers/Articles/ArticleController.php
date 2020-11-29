<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\ArticleStoreRequest;
use App\Http\Requests\Articles\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\User;
use App\Transformers\ArticleTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return Fractal::includes('author')->collection($articles, new ArticleTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleStoreRequest $request)
    {
        $article = new Article;
        $article->author_id = 1;
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->body = $request->body;
        $article->save();

        return Fractal::includes('author')->item($article, new ArticleTransformer());

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return Fractal::includes('author')->item($article, new ArticleTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $article->title = $request->get('title', $article->title);
        $article->slug = $request->has('title') ? Str::slug($request->get('title')) : $article->slug;
        $article->body = $request->get('body', $article->body);
        $article->save();

        return Fractal::includes('author')->item($article, new ArticleTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return void
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response(null, 200);
    }
}
