<?php

namespace App\Page;

use Amp\Future;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Stopwatch\Stopwatch;
use function Amp\async;

/**
 * Wrap a block to convert it to a Future.
 * Calls the option resolver on named arguments.
 *
 * @internal
 */
class BlockResolver extends Block
{
    public function __construct(
        private readonly Block $block,
        private readonly ?Stopwatch $stopwatch = null,
    ) {}

    public function __invoke(...$options): Future
    {
        $resolver = new OptionsResolver();
        $this->block->configureOptions($resolver);

        // Guess parameter name if the function is called positional arguments.
        foreach ($options as $key => $value) {
            if (is_numeric($key)) {
                unset($options[$key]);
                $parameters ??= (new \ReflectionMethod($this->block, '__invoke'))->getParameters();
                if (isset($parameters[$key])) {
                    $name = $parameters[$key]?->getName();
                    $options[$name] = $value;
                }
                // else, parameter is removed to follow default PHP behavior for extra parameters.
            }
        }

        $options = $resolver->resolve($options);

        return async(function () use ($options) {
            $event = $this->stopwatch?->start(get_class($this->block), 'page_block');
            try {
                return ($this->block)(...$options);
            } finally {
                $event?->stop();
            }
        });
    }
}
