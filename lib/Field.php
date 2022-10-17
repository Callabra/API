<?php

namespace Callabra;

class Field extends Api {

	public static function meta($module,$field) {

		self::setModule("fields");
		self::setAction("meta");


		self::addParameter("fields","module",$module);
		self::addParameter("fields","field",$field);

		$result = self::send();

		return $result;	

	}

	public static function states($country) {

		self::setModule("fields");
		self::setAction("states");


		self::addParameter("fields","country",$country);
		#self::addParameter("fields","field",$field);

		$result = self::send();

		return $result;	

	}






}

?>