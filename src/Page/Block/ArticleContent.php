<?php

namespace App\Page\Block;

use App\Page\Block;
use App\Page\View;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleContent extends Block
{
    use WithApiClient;

    public function __invoke(int $id): array|View
    {
        $data = $this->apiClient->get('/v2/articles/'.$id);

        return new View\ArticleContent($data['item']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->define('id')
                ->required()
                ->allowedTypes('int')
        ;
    }
}
