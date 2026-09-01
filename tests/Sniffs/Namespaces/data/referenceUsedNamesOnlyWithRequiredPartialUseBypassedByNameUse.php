<?php

namespace Whatever;

use Some\SubNamespace as SubNamespace;
use Some\SubNamespace\A;
use Some\SubNamespace\B as AliasedB;
use function Some\SubNamespace\doSomething;
use const Some\SubNamespace\CONSTANT;

class Foo
{

	public function test(): void
	{
		new SubNamespace\C();
		new A();
		new AliasedB();
		doSomething();
		echo CONSTANT;
	}

}
