<?php

namespace App\Page;

use Amp\Future;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Stopwatch\Stopwatch;
use function Amp\async;

class Builder
{
    public function __construct(
        private readonly ServiceLocator $blocks,
        private readonly Stopwatch $stopwatch,
    ) {
    }

    /**
     * Returns an async call for the block instantiation
     */
    public function get(string $fqcn, ...$options): Future
    {
        $block = $this->blocks->get($fqcn);
        assert($block instanceof Block);
        assert(is_callable($block));

        $resolver = new OptionsResolver();
        $block->configureOptions($resolver);
        $options = $resolver->resolve($options);

        return async(function () use ($block, $options) {
            $event = $this->stopwatch->start(get_class($block), 'page_block');
            try {
                return $block(...$options);
            } finally {
                $event->stop();
            }
        });
    }
}
