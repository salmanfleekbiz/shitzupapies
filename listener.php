<?php
//'// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
//'// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
//'// Set this to 0 once you go live or don't require logging.
//'define("DEBUG", 1);
//'// Set to 0 once you're ready to go live
//'define("USE_SANDBOX", 1);
//'define("LOG_FILE", "log.txt");
//'// Read POST data
//'// reading posted data directly from $_POST causes serialization
//'// issues with array data in POST. Reading raw POST data from input stream instead.
//'$raw_post_data = file_get_contents('php://input');
//'$raw_post_array = explode('&', $raw_post_data);
//'$myPost = array();
//'foreach ($raw_post_array as $keyval) {
//'	$keyval = explode ('=', $keyval);
//'	if (count($keyval) == 2)
//'		$myPost[$keyval[0]] = urldecode($keyval[1]);
//'}
//'// read the post from PayPal system and add 'cmd'
//'$req = 'cmd=_notify-validate';
//'if(function_exists('get_magic_quotes_gpc')) {
//'	$get_magic_quotes_exists = true;
//'}
//'foreach ($myPost as $key => $value) {
//'	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
//'		$value = urlencode(stripslashes($value));
//'	} else {
//'		$value = urlencode($value);
//'	}
//'	$req .= "&$key=$value";
//'}
//'// Post IPN data back to PayPal to validate the IPN data is genuine
//'// Without this step anyone can fake IPN data
//'if(USE_SANDBOX == true) {
//'	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
//'} else {
//'	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
//'}
//'$ch = curl_init($paypal_url);
//'if ($ch == FALSE) {
//'	return FALSE;
//'}
//'curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//'curl_setopt($ch, CURLOPT_POST, 1);
//'curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//'curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
//'curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
//'curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
//'curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
//'if(DEBUG == true) {
//'	curl_setopt($ch, CURLOPT_HEADER, 1);
//'	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
//'}
//'// CONFIG: Optional proxy configuration
//'//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//'//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
//'// Set TCP timeout to 30 seconds
//'curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
//'curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
//'// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
//'// of the certificate as shown below. Ensure the file is readable by the webserver.
//'// This is mandatory for some environments.
//'//$cert = __DIR__ . "./cacert.pem";
//'//curl_setopt($ch, CURLOPT_CAINFO, $cert);
//'$res = curl_exec($ch);
//'if (curl_errno($ch) != 0) // cURL error
//'	{
//'	if(DEBUG == true) {	
//'		error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
//'	}
//'	curl_close($ch);
//'	exit;
//'} else {
//'		// Log the entire HTTP response if debug is switched on.
//'		if(DEBUG == true) {
//'			error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
//'			error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
//'		}
//'		curl_close($ch);
//'}
//'// Inspect IPN validation result and act accordingly
//'// Split response headers and payload, a better way for strcmp
//'$tokens = explode("\r\n\r\n", trim($res));
//'$res = trim(end($tokens));
//'if (strcmp ($res, "VERIFIED") == 0) {
//'	// check whether the payment_status is Completed
//'	// check that txn_id has not been previously processed
//'	// check that receiver_email is your PayPal email
//'	// check that payment_amount/payment_currency are correct
//'	// process payment and mark item as paid.
//'	// assign posted variables to local variables
//'	//$item_name = $_POST['item_name'];
//'	//$item_number = $_POST['item_number'];
//'	//$payment_status = $_POST['payment_status'];
//'	//$payment_amount = $_POST['mc_gross'];
//'	//$payment_currency = $_POST['mc_currency'];
//'	//$txn_id = $_POST['txn_id'];
//'	//$receiver_email = $_POST['receiver_email'];
//'	//$payer_email = $_POST['payer_email'];
//'	
//'	if(DEBUG == true) {
//'		error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
//'	}
//'} else if (strcmp ($res, "INVALID") == 0) {
//'	// log for manual investigation
//'	// Add business logic here which deals with invalid IPN messages
//'	if(DEBUG == true) {
//'		error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
//'	}
//'}
?>


<?php 

include 'ipn_handler.class.php';


///**
// * Logs IPN messages to a file.
// */
class Logging_Ipn_Handler extends IPN_Handler
{
        public function process(array $post_data)
        {
                $data = parent::process($post_data);
				
				echo $data;


                if($data === FALSE)
                {
                        header('HTTP/1.0 400 Bad Request', true, 400);
                        exit;
                }
                
                $output = implode("\t", array(time(), json_encode($data)));
                file_put_contents('log.txt', $output.PHP_EOL, FILE_APPEND);
        }
}

date_default_timezone_set('Europe/Oslo');

$handler = new Logging_Ipn_Handler();
$handler->process($_POST);


//$ipn_post_data = $_POST;
//
//// Choose url
//if(array_key_exists('test_ipn', $ipn_post_data) && 1 === (int) $ipn_post_data['test_ipn'])
//    $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
//else
//    $url = 'https://www.paypal.com/cgi-bin/webscr';
//
//// Set up request to PayPal
//$request = curl_init();
//curl_setopt_array($request, array
//(
//    CURLOPT_URL => $url,
//    CURLOPT_POST => TRUE,
//    CURLOPT_POSTFIELDS => http_build_query(array('cmd' => '_notify-validate') + $ipn_post_data),
//    CURLOPT_RETURNTRANSFER => TRUE,
//    CURLOPT_HEADER => FALSE,
//));
//
//// Execute request and get response and status code
//$response = curl_exec($request);
//$status   = curl_getinfo($request, CURLINFO_HTTP_CODE);
//
//// Close connection
//curl_close($request);
//
//if($status == 200 && $response == 'VERIFIED')
//{
//    echo "All good";
//	// All good! Proceed...
//}
//else
//{
//	echo "Not good";
//    // Not good. Ignore, or log for investigation...
//}

?>