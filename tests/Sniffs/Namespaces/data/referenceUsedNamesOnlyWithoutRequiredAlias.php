<?php

namespace Whatever;

use Symfony\Component;
use Symfony\Component as SymfonyComponent;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotNull as NotNullAlias;
use Dibi;
use Dibi\Exception as DibiException;
use Dibi\Exception as DibiExceptionAlias;
use My;

use function My\func as my_function;
use const My\CONSTANT as MY_CONSTANT;

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

	#[NotNull]
	public $grault;

	#[NotNullAlias]
	public $garply;
}

throw new DibiException();
throw new \Dibi\Exception();
throw new Dibi\Exception();
throw new DibiExceptionAlias();

\My\func();
My\func();
my_function();

\My\CONSTANT;
My\CONSTANT;
MY_CONSTANT;
