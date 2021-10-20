<?php

namespace Callabra;

class Invoice {

	var $account;
	var $items;
	var $coupon;

	function account($id) {

			#Debug::log("test","tEST");

	}

	function addItem(string $name, string $description, float $unit_cost, int $quantity) {


	}

	function pastDue(string $id) {

		self::setModule("invoices");
		self::setAction("pastDue");

		self::addParameter("invoices", "id" , $id);

		$result = self::send();

		return $result;

	}




}

?>