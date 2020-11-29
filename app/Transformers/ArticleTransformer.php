<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;


class ArticleTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @return array
     * @var $resource
     */
    public function transform(Article $article)
    {
        return [

            'id' => $article->id,
            'author_id' => $article->author_id,
            'title' => $article->title,
            'slug' => $article->slug,
            'body' => $article->body,
            'created_at' => $article->created_at->format('d M Y'),
            'updated_at' => $article->updated_at->format('d M Y'),

        ];
    }

    public function includeAuthor(Article $article)
    {
        return $this->item($article->author(), new UserTransformer());
    }
}
