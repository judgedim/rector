<?php

declare(strict_types=1);

namespace Rector\PHPStanExtensions\Tests\Rule\NoDirectDocCommentCallRule;

use Iterator;
use PHPStan\Rules\Rule;
use Rector\PHPStanExtensions\Rule\NoDirectDocCommentCallRule;
use Symplify\PHPStanExtensions\Testing\AbstractServiceAwareRuleTestCase;

final class NoDirectDocCommentCallRuleTest extends AbstractServiceAwareRuleTestCase
{
    /**
     * @dataProvider provideData()
     * @param array<string|string[]|int[]> $expectedErrorsWithLines
     */
    public function testRule(string $filePath, array $expectedErrorsWithLines): void
    {
        $this->analyse([$filePath], $expectedErrorsWithLines);
    }

    public function provideData(): Iterator
    {
        yield [__DIR__ . '/Fixture/HasDirectDocCommentCall.php', [
            [NoDirectDocCommentCallRule::ERROR, 13]
        ]];
    }

    protected function getRule(): Rule
    {
        return $this->getRuleFromConfig(
            NoDirectDocCommentCallRule::class,
            __DIR__ . '/config/configured_rule.neon'
        );
    }
}
