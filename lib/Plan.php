<?php

namespace Callabra;

class Plan extends Callabra {

	public static function coupon($plan = null, $coupon = null)
	{

		self::setModule("plans");
		self::setAction("coupon");

		self::addParameter("plans", "plan" , $plan);
		self::addParameter("plans", "coupon" , $coupon);

		$result = self::send();

		return $result;

	}






}

?>