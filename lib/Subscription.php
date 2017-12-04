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


	public static function check($account, $plan, $coupon = null, $quantity = 1, $setup_fee = null, $trial_end = null) {

		self::setModule("subscriptions");
		self::setAction("check");

		self::addParameter("subscriptions", "account" , $account);
		self::addParameter("subscriptions", "plan" , $plan);
		self::addParameter("subscriptions", "coupon" , $coupon);
		self::addParameter("subscriptions", "quantity" , $quantity);
		self::addParameter("subscriptions", "trial_end" , $trial_end);


		$result = self::send();

		return $result;

	}


	public static function create($account, $plan, $coupon = null, $quantity = 1, $setup_fee = null, $trial_end = null, $order_id = null)
	{

		self::setModule("subscriptions");
		self::setAction("create");

		self::addParameter("subscriptions", "account" , $account);
		self::addParameter("subscriptions", "plan" , $plan);
		self::addParameter("subscriptions", "quantity" , $quantity);
		self::addParameter("subscriptions", "coupon" , $coupon);
		self::addParameter("subscriptions", "trial_end" , $trial_end);
		self::addParameter("subscriptions", "order_id" , $order_id);


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