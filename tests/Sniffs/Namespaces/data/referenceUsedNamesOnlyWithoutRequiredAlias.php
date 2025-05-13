<?php

namespace Whatever;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component;
use Symfony\Component as SymfonyComponent;

class Foo
{
	#[Assert\NotNull]
	public $foo;

	#[Component\Validator\Constraints\NotNull]
	public $bar;

	#[SymfonyComponent\Validator\Constraints\NotNull]
	public $baz;

	#[\Symfony\Component\Validator\Constraints\NotNull]
	public $qux;

	#[Component\Validator\Constraints\Foo\Bar]
	public $quux;

	#[\Symfony\Component\Validator\Constraints\Foo\Bar]
	public $corge;
}
