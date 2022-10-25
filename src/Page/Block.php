<?php

namespace App\Page;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * A block is the PHP part of a component.
 *
 * Hack to declare the method. The arguments are different for each subclass and defined by configured options.
 * @method array|View __invoke()
 */
abstract class Block
{
    public function configureOptions(OptionsResolver $resolver): void {}
}
