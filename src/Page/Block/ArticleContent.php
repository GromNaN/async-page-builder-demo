<?php

namespace App\Page\Block;

use App\Page\Block;
use App\Page\View;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleContent implements Block
{
    use WithApiClient;

    public function __invoke(array $options): array|View
    {
        $data = $this->apiClient->get('/v2/articles/'.$options['id']);

        return new View\ArticleContent($data['item']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('id')->setAllowedTypes('id', 'int');
    }
}
