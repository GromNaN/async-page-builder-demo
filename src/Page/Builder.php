<?php

namespace App\Page;

use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\Stopwatch\Stopwatch;

class Builder
{
    public function __construct(
        private readonly ServiceLocator $blocks,
        private readonly Stopwatch $stopwatch,
    ) {
    }

    /**
     * @template CLASS
     *
     * @param class-string<CLASS> $class
     *
     * @return CLASS
     */
    public function get(string $class): Block
    {
        return new BlockResolver($this->blocks->get($class), $this->stopwatch);
    }
}
