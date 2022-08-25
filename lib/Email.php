<?php

namespace Callabra;

class Email extends Api  {


	public static function create($to, $subject, $body )
	{

		self::setModule("emails");
		self::setAction("create");

		self::addParameter("emails","to",$to);
		self::addParameter("emails","subject",$subject);
		self::addParameter("emails","body",$body);

		$result = self::send();

		return $result;			
	}	

}
?>