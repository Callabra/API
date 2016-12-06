<?php

namespace Callabra;

class Subscription extends Callabra  {

	// var $account;
	// var $plan;
	// var $coupon;

	public static function get($id)
	{

		self::setModule("subscriptions");
		self::setAction("get");


		self::addParameter("subscriptions","id",$id);

		$result = self::send();

		return $result;			
	}


	public static function create($account, $plan, $quantity = 1, $coupon = null, $trial_end = null)
	{

		self::setModule("subscriptions");
		self::setAction("create");

		self::addParameter("subscriptions", "account" , $account);
		self::addParameter("subscriptions", "plan" , $plan);
		self::addParameter("subscriptions", "quantity" , $quantity);
		self::addParameter("subscriptions", "coupon" , $coupon);
		self::addParameter("subscriptions", "trial_end" , $trial_end);


		$result = self::send();

		return $result;

	}

	public static function renew($subscription)
	{

		self::setModule("subscriptions");
		self::setAction("renew");

		self::addParameter("subscriptions", "id" , $subscription);

		$result = self::send();

		return $result;

	}

	public static function cancel($subscription)
	{

		self::setModule("subscriptions");
		self::setAction("cancel");

		self::addParameter("subscriptions", "id" , $subscription);

		$result = self::send();

		return $result;

	}


	public static function suspend($subscription)
	{

		self::setModule("subscriptions");
		self::setAction("suspend");

		self::addParameter("subscriptions", "id" , $subscription);

		$result = self::send();

		return $result;

	}

	public static function refund($subscription)
	{

		self::setModule("subscriptions");
		self::setAction("refund");

		self::addParameter("subscriptions", "id" , $subscription);

		$result = self::send();

		return $result;

	}

} // end class Subscription

?>