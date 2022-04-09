<?php

namespace App\Page\Block;

use App\Page\Block;
use App\Page\View;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelatedArticles implements Block
{
    use WithApiClient;

    public function __invoke(array $options): array|View
    {
        $data = $this->apiClient->get('/v2/articles/'.$options['id']);

        $tags = array_slice(array_column($data['item']['tags'], 'slug'), 0, 3);

        $articles = $this->apiClient->get('/v2/articles?tags='.implode(',', $tags));

        return new View\Articles($articles['items']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->define('id')
            ->required()
            ->allowedTypes('int')
        ;
    }
}
