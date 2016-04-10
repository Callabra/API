<?

namespace Callabra;

class Subscription extends Callabra  {

	// var $account;
	// var $plan;
	// var $coupon;


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

	// public static function check($account, $plan, $quantity = 1, $coupon = null, $trial_end = null)
	// {

	// 	self::setModule("subscriptions");
	// 	self::setAction("create");

	// 	self::addParameter("subscriptions", "account" , $account);
	// 	self::addParameter("subscriptions", "plan" , $plan);
	// 	self::addParameter("subscriptions", "quantity" , $quantity);
	// 	self::addParameter("subscriptions", "coupon" , $coupon);
	// 	self::addParameter("subscriptions", "trial_end" , $trial_end);


	// 	$result = self::send();

	// 	return $result;

	// }




} // end class Subscription