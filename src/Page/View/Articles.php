<?php

namespace App\Page\View;

use App\Page\View;

class Articles implements View
{
    public readonly iterable $articles;

    public function __construct(array $data)
    {
        $this->articles = array_map(
            fn ($article) => new ArticleForList($article),
            $data
        );
    }
}
