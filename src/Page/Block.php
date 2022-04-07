<?php

namespace App\Page;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface Block
{
    public function __invoke(array $options): array|View;

    public function configureOptions(OptionsResolver $resolver): void;
}
