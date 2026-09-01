<?php

namespace Whatever;

use Some\SubNamespace as Other;
use Some\SubNamespace\A;

class Foo
{

	public function test(): void
	{
		new Other\B();
		new A();
	}

}
