<?php

namespace app\components;

use Yii;

/**
* class for generalfunctions
*/
class General
{
	
	public static function br2nl($text)
	{
	    return  preg_replace('/<br\\s*?\/??>/i', '', $text);
	}


}