<?php

namespace App\Page;

use Amp\Future;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Amp\async;

class Builder
{
    public function __construct(
        private readonly ServiceLocator $blocks
    ) {
    }

    /**
     * Returns an async call for the block instantiation
     */
    public function get(string $fqcn, array $options = []): Future
    {
        $block = $this->blocks->get($fqcn);
        assert($block instanceof Block);

        $resolver = new OptionsResolver();
        $block->configureOptions($resolver);
        $options = $resolver->resolve($options);

        return async($block(...), $options);
    }
}
