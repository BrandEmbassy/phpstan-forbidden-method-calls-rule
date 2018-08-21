<?php declare(strict_types = 1);

namespace BrandEmbassy\ForbiddenMethodCallsRule;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Type\ObjectType;

class ForbiddenMethodCallsRule implements Rule
{

    /**
     * @var ObjectType[][]
     */
    private $forbiddenMethods = [];

    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    public function addForbiddenMethod(string $typeName, string $methodName): void
    {
        $this->forbiddenMethods[$methodName][] = new ObjectType($typeName);
    }

    /**
     * @param MethodCall $node
     * @param Scope $scope
     * @return string[]
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $name = $node->name;
        if (\is_object($name) && method_exists($name, '__toString')) {
            $name = $name->__toString();
        }

        if (!\is_string($name)) {
            return [];
        }

        $forbiddenTypes = $this->forbiddenMethods[$name] ?? [];

        foreach ($forbiddenTypes as $forbiddenType) {
            $type = $scope->getType($node->var);
            if ($forbiddenType->isSuperTypeOf($type)->yes()) {
                return [
                    sprintf(
                        'Calling forbidden method %s:%s().',
                        $forbiddenType->getClassName(),
                        $name
                    ),
                ];
            }
        }

        return [];
    }

}
