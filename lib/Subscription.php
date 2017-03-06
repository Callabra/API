<?php

namespace Callabra;

class Subscription extends Callabra  {

	public static function details($id)
	{

		self::setModule("subscriptions");
		self::setAction("get");


		self::addParameter("subscriptions","id",$id);

		$result = self::send();

		return $result;			
	}

	public static function update($id, $amount)
	{

		self::setModule("subscriptions");
		self::setAction("update");

		self::addParameter("subscriptions", "id" , $id);
		self::addParameter("subscriptions", "amount" , $amount);
		#self::addParameter("subscriptions", "quantity" , $quantity);
		#self::addParameter("subscriptions", "coupon" , $coupon);



		$result = self::send();

		return $result;

	}

	public static function update($id, $amount)
	{

		self::setModule("subscriptions");
		self::setAction("update");

		self::addParameter("subscriptions", "id" , $id);
		self::addParameter("subscriptions", "amount" , $amount);
		#self::addParameter("subscriptions", "quantity" , $quantity);
		#self::addParameter("subscriptions", "coupon" , $coupon);



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