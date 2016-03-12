<?
namespace {

	use Callabra\Invoice;


	class Callabra {
		
		public static $instance;
		public static $key;

		public static $module;
		public static $action;

		public static $parameters;


		public static function endpoint()
		{



			if(isset($_SERVER['PRODUCTION'])) {
				$endpoint = "https://api.callabra.com";
			} else {
				$endpoint = "http://api.klevva.com";
			}

			$endpoint = $endpoint . "/" . self::$module . "/" . self::$action . "/";

			#Debug::log($endpoint,"endpoint");

			return $endpoint;
		}


		public static function setInstance($instance)
		{
			self::$instance = $instance;
		}

		public static function setKey($key)
		{
			self::$key = $key;
		}

		public static function setModule($module)
		{
			self::$module = $module;
		}

		public static function setAction($action)
		{
			self::$action = $action;
		}

		public static function add($key,$value)
		{
			self::$parameters[$key] = $value;
		}

		public static function addParameter($module, $key, $value)
		{
			self::$parameters['PARAMETERS'][$module][$key] = $value;
		}

		public static function addParameters($module, $parameters)
		{
			foreach($parameters as $key => $value)
			{
				self::$parameters['PARAMETERS'][$module][$key] = $value;
			}
		}

		public static function encode($array)
		{
			return http_build_query($array);
		}

		public static function stringify($array)
		{
			foreach($array as $key => $value)
			{
				$string .= $key.'='.$value.'&';
			}

			$string = rtrim($string, '&');

			return $string;
		}

		public static function send()
		{
			self::add("INSTANCE",self::$instance);
			self::add("KEY",self::$key);

			//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, self::endpoint() );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch,CURLOPT_POST, count(self::$parameters));
			curl_setopt($ch,CURLOPT_POSTFIELDS, self::encode(self::$parameters));

			//execute post
			 $result = curl_exec($ch);

			 self::$parameters = null; // reset parameters after each send request

			 #Debug::log($result,"RAWRESPONSE"); 

			 #print_r($result);

			 return json_decode($result);
		}

		public static function authenticate($module, $email, $password)
		{

			self::setModule($module);
			self::setAction("authenticate");
			self::addParameter($module, "email" , $email);

			// need to figure out the most secure way to transmit sub-user passwords to api.
			#$password = password_hash($password, PASSWORD_DEFAULT); // always encrypt the password before transmitting it.

			self::addParameter($module, "password", $password);

			$result = self::send();



			return $result;

		}

		public static function create($module, array $parameters)
		{

			#print "saveCallabra";

			self::setModule($module);
			self::setAction("create");
			#self::addParameter($module, "id" , $id);
			self::addParameters($module, $parameters);

			$result = self::send();

			

			return $result;
		}


		public static function update($module, $id, array $parameters, $all = false)
		{

			#print "saveCallabra";

			self::setModule($module);
			self::setAction("update");
			self::addParameter($module, "id" , $id);
			self::addParameter($module,"all", $all);
			self::addParameters($module, $parameters);

			$result = self::send();

			

			return $result;
		}




		/* DEPRECATED - use create or update instead */
		public static function save($module, $id, array $parameters)
		{

			#print "saveCallabra";

			self::setModule($module);
			self::setAction("save");
			self::addParameter($module, "id" , $id);
			self::addParameters($module, $parameters);

			$result = self::send();

			

			return $result;
		}

		public static function search($module, array $parameters, $orderBy = 'date_created', $orderDir = 'desc')
		{
			self::setModule($module);
			self::setAction("search");
			self::addParameters($module,$parameters);

			self::add("orderBy",$orderBy);
			self::add("orderDir",$orderDir);	
			

			$result = self::send();

			return $result;

		}


		public static function details($module, $id)
		{

			#Debug::log("ID",$id);

			self::setModule($module);
			self::setAction("get");
			self::addParameter($module,"id",$id);

			$result = self::send();

			return $result;			
		}

		public static function coupon($code, $related) {

			self::setModule("coupons");
			self::setAction("coupon");

			self::addParameter("coupons", "code", $code);

			$result = self::send();

			return $result;

		}

		public static function invoice(string $account, array $invoice, string $coupon = null)
		{

			#Debug::log("ID",$id);

			self::setModule("invoices");
			self::setAction("invoice");
			#self::addParameters("payments", $parameters);
			self::addParameter("invoices","account",$account);
			self::addParameters("invoices", $invoice);
			self::addParameter("coupon",$coupon);

			$result = self::send();

			return $result;			
		}



		public static function charge(array $parameters, array $invoice)
		{

			#Debug::log("ID",$id);

			self::setModule("payments");
			self::setAction("charge");
			self::addParameters("payments", $parameters);
			self::addParameters("invoices", $invoice);

			$result = self::send();

			return $result;			
		}


		public static function related($module, $id, $related) 
		{

			self::setModule($module);
			self::setAction("related");
			self::addParameter($module,"id",$id);
			self::addParameter($module,"related",$related);

			$result = self::send();

			#Debug::log($result,"result@details");

			return $result;


		}

		public static function relation($module, $id, $related_module, $related_id) 
		{

			self::setModule($module);
			self::setAction("relation");
			self::addParameter($module,"id",$id);
			self::addParameter($module,"related_module",$related_module);
			self::addParameter($module,"related_id",$related_id);

			$result = self::send();

			#Debug::log($result,"result@relation");

			return $result;


		}

		public static function validate($module, $parameters, $required = false, $all = false) 
		{
			self::setModule($module);
			self::setAction("validate");
			#self::addParameter($module, "required" , $required);
			self::addParameter($module, "required" , true);
			self::addParameter($module, "all" , $all);
			self::addParameters($module, $parameters);

			$result = self::send();

			#Debug::log($result,"result@validate");

			return $result;

		}

		public static function email($to, $subject, $body)
		{
			self::setModule("accounts");
			self::setAction("email");
			self::addParameter("accounts","to",$to);
			self::addParameter("accounts","subject",$subject);
			self::addParameter("accounts","body",$body);

			$result = self::send();

			Debug::log($result,"result@details");

			return $result;

		}

		public static function field($module, $field, $parameters = false)
		{

			self::setModule($module);
			self::setAction("field");
			self::addParameter($module,"field",$field);

			if(is_array($parameters)) {

				foreach($parameters as $key => $value) {
					self::addParameter($module,$key,$value);
				}
				
			}

			$result = self::send();

			#Debug::log($result,"result@details");

			return $result;


		}

		public static function sendInvoice($id) {
			self::setModule('invoices');
			self::setAction("sendInvoice");
			self::addParameter("invoices","id",$id);


			$result = self::send();

			#Debug::log($result,"result@details");

			return $result;	
		}



	} // end class Callabra


} // end namespace

?>