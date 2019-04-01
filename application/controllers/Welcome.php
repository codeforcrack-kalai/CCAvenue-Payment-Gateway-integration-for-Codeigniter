<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->library('someclass');
		//$this->someclass->some_method();  // Object instances will always be lower case
		$this->load->view('header');
		$this->load->view('payment');
		$this->load->view('footer');
	}



	public function save()
	{

		$data=$this->input->post(array(
			'tid'=>'tid',
'merchant_id'=>'merchant_id',
'order_id'=>'order_id',
'amount'=>'amount',
'currency'=>'currency',
'redirect_url'=>'redirect_url',
'cancel_url'=>'cancel_url',
'language'=>'language',
'delivery_name'=>'delivery_name',
'delivery_address'=>'delivery_address',
'delivery_city'=>'delivery_city',
'delivery_state'=>'delivery_state',
'delivery_zip'=>'delivery_zip',
'delivery_country'=>'delivery_country',
'delivery_tel'=>'delivery_tel'

		));

//var_dump($data);



	
	$merchant_data='';
	$working_key='change_with_your_working_key';//Shared by CCAVENUES
	$access_code='change_with_your_access_code';//Shared by CCAVENUES
	
	foreach ($data as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	//$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	$this->load->library('someclass');

	$encrypted_data=$this->someclass->encrypt($merchant_data,$working_key); 

	var_dump($encrypted_data);

?>
<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form></center><script language='javascript'>document.redirect.submit();</script>


<?php
		echo "Payment Works";
	}
}
