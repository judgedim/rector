<?php

declare(strict_types=1);

namespace Rector\PHPStanExtensions\Tests\Rule\NoDirectDocCommentCallRule\Fixture;

use PhpParser\Node\Name;

final class HasDirectDocCommentCall
{
    public function test(Name $node): void
    {
        $comments = $node->getDocComment();
    }
}
