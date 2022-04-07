<?php

namespace App\Page\View;

use App\Page\View;

class ArticleContent implements View
{
    public readonly string $title;
    public readonly \DateTimeInterface $publishedAt;
    public readonly string $body;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->publishedAt = new \DateTime($data['publishedAt']);
        $this->body = $data['body'];
    }
}
