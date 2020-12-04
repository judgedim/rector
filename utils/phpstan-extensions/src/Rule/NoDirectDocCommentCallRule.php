<?php

declare(strict_types=1);

namespace Rector\PHPStanExtensions\Rule;

use Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\NodeFinder;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Symplify\PHPStanRules\Naming\SimpleNameResolver;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;

/**
 * @see \Rector\PHPStanExtensions\Tests\Rule\NoDirectDocCommentCallRule\NoDirectDocCommentCallRuleTest
 */
final class NoDirectDocCommentCallRule implements Rule
{
    /**
     * @var string
     */
    public const ERROR = 'getDocComment() or getComment() direct call is not allowed. Use $node->getAttribute(PhpDocInfo::class) to get PhpDocInfo object and work with that';
    /**
     * @var SimpleNameResolver
     */
    private $simpleNameResolver;

    public function __construct(SimpleNameResolver $simpleNameResolver)
    {
        $this->simpleNameResolver = $simpleNameResolver;
    }

    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    /**
     * @param MethodCall $node
     * @return string[]
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (! $this->simpleNameResolver->isNames($node->name, ['getComments', 'getDocComment'])) {
            return [];
        }

        return [self::ERROR];
    }
}
