<?php

namespace App\Page\View;

use App\Page\View;

class ArticleForList implements View
{
    public readonly string $id;
    public readonly string $title;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
    }
}
