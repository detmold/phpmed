<?php

namespace Medhelp\MedhelpBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MedhelpMedhelpBundle extends Bundle
{
	public function getParent() 
	{
		return "FOSUserBundle";
	}
}
