<?php
session_start();
include "dbkon.php";
include "funkcije.php";

$ime = $conn->real_escape_string($_REQUEST['ime']);
$prezime = $conn->real_escape_string($_REQUEST['prezime']);
$adresa = $conn->real_escape_string($_REQUEST['adresa']);
$grad = $conn->real_escape_string($_REQUEST['grad']);
$drzava = $conn->real_escape_string($_REQUEST['drzava']);
$postanski = $conn->real_escape_string($_REQUEST['postanski']);
$email = $conn->real_escape_string($_REQUEST['email']);
$telefon = $conn->real_escape_string($_REQUEST['telefon']);
$kompanija = $conn->real_escape_string($_REQUEST['kompanija']);
$proizvodi = implode(",", $_SESSION['products']);
$kolicine = implode(",", $_SESSION['quantities']);
$ttl = $_SESSION['total'];
$total = str_replace(".", "", number_format((float)$_SESSION['total'], 2, '.', ''));

$idnarudzbe = Insert("narudzbe", "ime, prezime, adresa, grad, drzava, postanski, email, telefon, kompanija, proizvodi, kolicine, total", "'$ime', '$prezime', '$adresa', '$grad', '$drzava', '$postanski', '$email', '$telefon', '$kompanija', '$proizvodi', '$kolicine', '$ttl'");

$_SESSION['idnarudzbe'] = $idnarudzbe;
$_SESSION['adresa'] = $adresa;
$_SESSION['email'] = $email;
$_SESSION['telefon'] = $telefon;


$brojkartice = $conn->real_escape_string($_REQUEST['brojkartice']);
$cvv = $conn->real_escape_string($_REQUEST['cvv']);
$datumisteka = $conn->real_escape_string($_REQUEST['datumisteka']);

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$buyer = array(
	'ch_full_name' 		=> $ime.' '.$prezime,		
	'ch_address'		=> $adresa,				
	'ch_city'			=> $grad,					
	'ch_zip'			=> $postanski,					
	'ch_country'		=> $drzava,				
	'ch_phone'			=> $telefon,					
	'ch_email'			=> $email					
);

$card 	= array(
	'pan' 				=> $brojkartice,						
	'cvv'				=> $cvv,						
	'expiration_date' 	=> $datumisteka			
);

$order = array(
	'order_info'		=> 'Narudzba br. '.$idnarudzbe,				
	'order_number'  	=>  uniqid(),				
	'amount'			=> 	$total, //15,80				
	'currency'			=> 'BAM'					
);

if ( (isset($_POST['MD'])) || (isset($_POST['PaRes'])) )
{
	$pikpay_response = SecureTerminal::init()->listener();
}
else
{
	$pikpay_response = WebPay::transaction()->order($order)->buyer($buyer)->card($card)->pay();
}


if ($pikpay_response !== FALSE)
{
	// Check if card is 3D secure
	if (isset($pikpay_response->{'acs-url'}))
	{
		$TermUrl = $current_url;
		$MD 	 = $pikpay_response->{'authenticity-token'};
		$PaReq 	 = $pikpay_response->{'pareq'};
		$AcsUrl  = $pikpay_response->{'acs-url'};

	    echo "

	    <!DOCTYPE html>
		<html>
		  <head>
		    <title>3D Secure verifikacija</title>
		    <script language='Javascript'>
		      function OnLoadEvent() { document.form.submit(); }
		    </script>
		  </head>
		  <body OnLoad='OnLoadEvent();'>
		    Pokretanje 3-D secure forme, priÄŤekajte ...
		    <form name='form' action='{$AcsUrl}' method='post'>
		      <input type='hidden' name='PaReq' value='{$PaReq}'>
		      <input type='hidden' name='TermUrl' value='{$TermUrl}'>
		      <input type='hidden' name='MD' value='{$MD}'>
		      <noscript>
		        <p>Molimo vas da kliknete na dugme 'Nastavi'.</p><input id='to-asc-button' value='Nastavi' type='submit'>
		      </noscript>
		    </form>
		    </body>
		</html>

	    ";
	    exit();
	}

	elseif ($pikpay_response->{'response-code'} == '0000')
	{
		Update("narudzbe", "placeno='da'",  $idnarudzbe);
		$_SESSION['products'] = array();
		$_SESSION['quantities'] = array();
		echo "<script>window.location='completed.php';</script>";
		exit();
	}

	else
	{
		//"ODBIJENA TRANSAKCIJA";
		echo "<script>window.location='error.php';</script>";
		exit();
	}
}

else
{
	//"NEUSPJESNA TRANSAKCIJA";
	echo "<script>window.location='error.php';</script>";
	exit();
}






/**
 * ----------------
 * NE DIRATI ISPOD
 * ----------------
 */


class WebPay {

	private $_buyer = array(
		'ch_full_name',				// alphanumeric 	buyer's full name
		'ch_address',				// alphanumeric 	buyer's address
		'ch_city',					// alphanumeric		buyer's city
		'ch_zip',					// alphanumeric 	buyer's zip
		'ch_country',				// alphanumeric 	buyer's country
		'ch_phone',					// alphanumeric 	buyer's phone
		'ch_email'					// alphanumeric 	buyer's email
	);

	private $_card 	= array(
		'pan',						// int 	valid card number
		'cvv',						// int 	optional for Maestro cards; must be not set for MOTO transactions
		'expiration_date'			// numeric (YYMM) 	this value can not be in the past
	);

	private $_order = array(
		'order_info',				// alphanumeric 	short description of order being processed
		'order_number',				// alphanumeric 	unique identifier
		'amount',					// integer 			amount is in minor units, ie. 10.24 USD is sent as 1024
		'currency'					// alpha 			possible values are USD, EUR, BAM or HRK
	);

	private $_other = array(
		'language',					// alpha 			used for errors localization, possible values are en, es, ba or hr
		'transaction_type',			// alpha 			possible values are authorize, purchase, capture, refund or void
		'authenticity_token',		// alphanumeric 	autogenerated value for merchant account, can be found under merchant settings
		'key'						// alpha 			shared secret used to calculate digest value
	);

	private $_ip = '127.0.0.1';		// alphanumeric 	valid IPv4 address

	private $_default_settings;		// Default settings

	
	/**
	 *
	 * Sets initial WebPay API settings -> Needs to be called first
	 *
	 * @param 	alpha 	possible values are: authorize, purchase, capture, refund or void 
	 * @return 	object 
	 *
	 */
	public static function transaction($type = NULL)
	{
		return new WebPay($type);
	}

	public function __construct($type)
	{
		// Load initial settings
		$this->_default_settings = array(
	
			'language' => 'hr',														// alpha 			used for errors localization, possible values are en, es, ba or hr
			'transaction_type' => 'purchase',										// alpha 			possible values are authorize, purchase, capture, refund or void
			'authenticity_token' => '89af3b94fbc461343d331cc315e9d94f451902af',		// alphanumeric 	autogenerated value for merchant account, can be found under merchant settings
			'key' => 'ID#3Sol',													// alpha 			shared secret used to calculate digest value
			'currency' => 'BAM',													// alpha 			possible values are USD, EUR, BAM or HRK
			'test' => TRUE,															// bool 			uses different API URL-s, TRUE - use testing URL, FALSE - use real URL
		);

		// Check transaction type and set default if not defined
		if ($type !== NULL AND in_array($type, array('authorize', 'purchase', 'capture', 'refund', 'void')))
		{
			$this->_other['transaction_type'] = $type;
		}

		else 
		{
			$this->_other['transaction_type'] = $this->_default_settings['transaction_type'];
		}

		// Set initial variables
		$this->_other['language'] = $this->_default_settings['language'];
		$this->_other['authenticity_token'] = $this->_default_settings['authenticity_token'];
		$this->_other['key'] = $this->_default_settings['key'];
		$this->_order['currency'] = $this->_default_settings['currency'];

		if ($this->_default_settings['test'] === FALSE)
		{
			$this->_ip = $_SERVER['REMOTE_ADDR']; // use real IP address
		}	
	}

	/**
	 *
	 * Prepares an order
	 *
	 * @param 	$data 					array 	order_number, order_info, amount
	 * @return 	object 
	 *
	 */
	public function order($data)
	{
		$this->_order['order_number'] = $data['order_number'];
		$this->_order['order_info'] = $data['order_info'];
		$this->_order['amount'] = $data['amount'];

		return $this;
	}

	/**
	 *
	 * Fills in buyer's data
	 *
	 * @param 	$data 	array 	ch_full_name, ch_address, ch_city, ch_zip, ch_country, ch_phone, ch_email
	 * @return 	object
	 *
	 */
	public function buyer($data)
	{
		$this->_buyer['ch_full_name'] = $data['ch_full_name'];
		$this->_buyer['ch_address'] = $data['ch_address'];
		$this->_buyer['ch_city'] = $data['ch_city'];
		$this->_buyer['ch_zip'] = $data['ch_zip'];
		$this->_buyer['ch_country'] = $data['ch_country'];
		$this->_buyer['ch_phone'] = $data['ch_phone'];
		$this->_buyer['ch_email'] = $data['ch_email'];

		return $this;
	}	

	/**
	 *
	 * Fills in card data
	 *
	 * @param 	$data 	array 	pan, cvv, expiration_date
	 * @return 	object
	 *
	 */
	public function card($data)
	{
		$this->_card['pan'] = preg_replace('/\s+/', '', $data['pan']);
		$this->_card['cvv'] = $data['cvv'];
		$this->_card['expiration_date'] = $data['expiration_date'];

		return $this;
	}
	

	/**
	 *
	 * Places an order and executes the transaction
	 *
	 * @return 	$response 		mixed 	request response
	 *
	 */
	public function pay()
	{
		// Get cURL resource
		$request = curl_init();

		// Set options
		curl_setopt_array($request, array(
		    
		    CURLOPT_URL => $this->_get_api_url(),
		    CURLOPT_HTTPHEADER => array('Content-Type: application/xml', 'Accept: application/xml'),
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => $this->_generate_xml(),
		    CURLOPT_RETURNTRANSFER => 1,

		    // Remove after testing for security reasons
		    CURLOPT_SSL_VERIFYPEER => 0,
        	CURLOPT_SSL_VERIFYHOST => 0,
		));

		// Send the request & save response to $response
		$response = curl_exec($request);

		// Get HTTP status code
		$http_code = curl_getinfo($request, CURLINFO_HTTP_CODE);
		
		// Close request
		curl_close($request);

		// Check if the request if created
		if ($http_code == 201)
		{
			return simplexml_load_string($response);
		}

		else 
		{
			// Request failed
			return FALSE;
		}		
	}	

	/**
	 *
	 * Generates digest
	 *
	 * @return 	alphanumeric diegest 
	 *
	 */
	private function _generate_digest()
	{
		$key = $this->_other['key'];
		$order_number = $this->_order['order_number'];
		$amount = $this->_order['amount'];
		$currency = $this->_order['currency'];

		// Concat into a string
		$raw_digest = $key.$order_number.$amount.$currency;
		return sha1($raw_digest);
	}

	/**
	 * 
	 * Generates needed XML file 
	 * @return string xml
	 * 
	 */
	private function _generate_xml()
	{
		$transaction = new SimpleXMLElement('<transaction/>');
		
		$transaction->addChild('transaction-type', 	$this->_other['transaction_type']);
		$transaction->addChild('amount', 			$this->_order['amount']);
		$transaction->addChild('cvv', 				$this->_card['cvv']);
		$transaction->addChild('expiration-date', 	$this->_card['expiration_date']);
		$transaction->addChild('pan', 				$this->_card['pan']);
		$transaction->addChild('ip', 				$this->_ip);
		$transaction->addChild('order-info', 		$this->_order['order_info']);
		$transaction->addChild('ch-address', 		$this->_buyer['ch_address']);
		$transaction->addChild('ch-city', 			$this->_buyer['ch_city']);
		$transaction->addChild('ch-country', 		$this->_buyer['ch_country']);
		$transaction->addChild('ch-email', 			$this->_buyer['ch_email']);
		$transaction->addChild('ch-full-name', 		$this->_buyer['ch_full_name']);
		$transaction->addChild('ch-phone', 			$this->_buyer['ch_phone']);
		$transaction->addChild('ch-zip', 			$this->_buyer['ch_zip']);
		$transaction->addChild('currency', 			$this->_order['currency']);
		$transaction->addChild('digest', 			$this->_generate_digest());
		$transaction->addChild('authenticity-token',$this->_other['authenticity_token']);
		$transaction->addChild('order-number', 		$this->_order['order_number']);
		$transaction->addChild('language', 			$this->_other['language']);

		return $transaction->asXML();
	}

	/**
	 * Get API URL according to transaction type
	 * @return url
	 */
	private function _get_api_url()
	{
		$interfix = ($this->_default_settings['test'] === TRUE) ? 'test' : '';

		if ($this->_other['transaction_type'] == 'capture')
		{
			return 'https://ipg'.$interfix.'.pikpay.ba/transactions/'.$this->_order['order_number'].'/capture.xml';
		}

		elseif ($this->_other['transaction_type'] == 'refund')
		{
			return 'https://ipg'.$interfix.'.pikpay.ba/transactions/'.$this->_order['order_number'].'/refund.xml';
		}
		
		elseif ($this->_other['transaction_type'] == 'void')
		{
			return 'https://ipg'.$interfix.'.pikpay.ba/transactions/'.$this->_order['order_number'].'/void.xml';
		}

		else 
		{
			return 'https://ipg'.$interfix.'.pikpay.ba/api';
		}
	}
}


/**
 * 3D Secure terminal
 */

class SecureTerminal {

	private $_default_settings;		// Default settings

	private $_MD;
	private $_PaRes;


	public function __construct()
	{
		$this->_default_settings = array(

			'test' => TRUE,															// bool 			uses different API URL-s, TRUE - use testing URL, FALSE - use real URL
		);
	}

	public static function init()
	{
		return new SecureTerminal();
	}

	public function listener()
	{
		if ($_POST)
		{
			if (isset($_POST['MD']))
			{
				$this->_MD = $_POST['MD'];
			}

			if (isset($_POST['PaRes']))
			{
				$this->_PaRes = $_POST['PaRes'];
			}

			return $this->_finish_transaction();
		}

		else 
		{
			throw HTTP_Exception::factory(404, 'Stranica ne postoji!');	
		}
	}

	/**
	 * 
	 * Finishes the transaction 
	 * @return string XML OR FALSE
	 * 
	 */
	private function _finish_transaction()
	{
		// Get cURL resource
		$request = curl_init();

		// Set options
		curl_setopt_array($request, array(
		    
		    CURLOPT_URL => $this->_get_api_url(),
		    CURLOPT_HTTPHEADER => array('Content-Type: application/xml', 'Accept: application/xml'),
		    CURLOPT_POST => 1,
		    CURLOPT_POSTFIELDS => $this->_generate_xml(),
		    CURLOPT_RETURNTRANSFER => 1,

		    // Remove after testing for security reasons
		    CURLOPT_SSL_VERIFYPEER => 0,
        	CURLOPT_SSL_VERIFYHOST => 0,
		));

		// Send the request & save response to $response
		$response = curl_exec($request);

		// Get HTTP status code
		$http_code = curl_getinfo($request, CURLINFO_HTTP_CODE);
		
		// Close request
		curl_close($request);

		// Check if the request if created
		if ($http_code == 201)
		{
			return simplexml_load_string($response);
		}

		return FALSE;
	}


	/**
	 * 
	 * Generates needed XML file 
	 * @return string xml
	 * 
	 */
	private function _generate_xml()
	{
		$secure_message = new SimpleXMLElement('<secure-message/>');
		
		$secure_message->addChild('MD', $this->_MD);
		$secure_message->addChild('PaRes', $this->_PaRes);

		return $secure_message->asXML();
	}

	/**
	 * Get API URL
	 * @return url
	 */
	private function _get_api_url()
	{
		$interfix = ($this->_default_settings['test'] === TRUE) ? 'test' : '';

		return 'https://ipg'.$interfix.'.pikpay.ba/pares';
	}
}
?>