<?php

namespace Rector\SOLID\Tests\Rector\Class_\RepeatedLiteralToClassConstantRector\Fixture;

class SomeClass
{
    public function run($key, $items)
    {
        if ($key === 'requires') {
            return $items['requires'];
        }

        return $items['requires'];
    }
}

?>
-----
<?php

namespace Rector\SOLID\Tests\Rector\Class_\RepeatedLiteralToClassConstantRector\Fixture;

class SomeClass
{
    /**
     * @var string
     */
    private const REQUIRES = 'requires';
    public function run($key, $items)
    {
        if ($key === self::REQUIRES) {
            return $items[self::REQUIRES];
        }

        return $items[self::REQUIRES];
    }
}

?>
