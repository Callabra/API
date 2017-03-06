<?php

namespace Callabra;

class Account extends Callabra  {


	public static function get($id)
	{

		self::setModule("accounts");
		self::setAction("get");


		self::addParameter("accounts","id",$id);

		$result = self::send();

		return $result;			
	}	


	public static function subscriptions($id,$status) {

		self::setModule("subscriptions");
		self::setAction("search");

		$parameters['account'] = $id;
		$parameters['status'] = $status;

		self::addParameters("subscriptions",array('WHERE'=>$parameters));

		$result = self::send();

		return $result;	

	}


}
?>