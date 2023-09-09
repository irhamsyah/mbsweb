<?php
namespace Tuta\Terbilang\Facades;

use Illuminate\Support\Facades\Facade;

class TerbilangFacade extends Facade{

	/**
	* Get the registered name of the component.
	*
	* @return string
	*/
	protected static function getFacadeAccessor() 
	{
		return 'terbilang';
	}

}
