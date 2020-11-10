<?php declare(strict_types = 1);

namespace PHPStan\Rule\Nette;

use PHPStan\Reflection\PropertyReflection;
use PHPStan\Rules\Properties\ReadWritePropertiesExtension;

class PresenterInjectedPropertiesExtension implements ReadWritePropertiesExtension
{

	public function isAlwaysRead(PropertyReflection $property, string $propertyName): bool
	{
		return false;
	}

	public function isAlwaysWritten(PropertyReflection $property, string $propertyName): bool
	{
		return false;
	}

	public function isInitialized(PropertyReflection $property, string $propertyName): bool
	{
		return $property->isPublic() &&
			$property->getDeclaringClass()->isSubclassOf('Nette\Application\UI\Presenter') &&
			strpos($property->getDocComment() ?? '', '@inject') !== false;
	}

}