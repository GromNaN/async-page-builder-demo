<?php

namespace App\Page\Block;

use App\Page\Block;
use App\Page\BlockWithOptions;
use App\Page\View;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LastArticles extends Block
{
    use WithApiClient;

    public function __invoke(int $size): array|View
    {
        $articles = $this->apiClient->get('/v2/articles?limit='.$size);

        return new View\Articles($articles['items']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->define('size')
                ->default(30)
                ->allowedTypes('int')
                ->allowedValues(fn (int $value): bool => $value > 1 && $value < 100)
        ;
    }
}
