<?php

namespace Callabra;

class Field extends Callabra {

	function meta($module,$field) {

		self::setModule("fields");
		self::setAction("meta");


		self::addParameter("fields","module",$module);
		self::addParameter("fields","field",$field);

		$result = self::send();

		return $result;	

	}

	function states($country) {

		self::setModule("fields");
		self::setAction("states");


		self::addParameter("fields","country",$country);
		#self::addParameter("fields","field",$field);

		$result = self::send();

		return $result;	

	}






}

?>