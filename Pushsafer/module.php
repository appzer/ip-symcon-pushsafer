<?
// Pushsafer Push Notification Service
class Pushsafer extends IPSModule
{
	private $privatekey = "";
	private $title = "";
	private $device = "";
	private $icon = "";
	private $sound = "";
	private $vibration = "";
	private $time2live = "";
	private $url = "";
	private $urltitle = "";
	    
	public function Create()
	{
		//Never delete this line!
        parent::Create();
		
		//These lines are parsed on Symcon Startup or Instance creation
		//You cannot use variables here. Just static values.
		
		$this->RegisterPropertyString("privatekey", "XXXXXXXXXXXXXXXXXXXX");
		$this->RegisterPropertyString("title", "IP-Symcon");
		$this->RegisterPropertyString("device", "a");
		$this->RegisterPropertyString("icon", "1");
		$this->RegisterPropertyString("sound", "1");
		$this->RegisterPropertyString("vibration", "3");
		$this->RegisterPropertyString("time2live", "0");
		$this->RegisterPropertyString("url", "https://www.pushsafer.com");
		$this->RegisterPropertyString("urltitle", "Open Pushsafer.com");
   	}
	
	public function ApplyChanges() 
	{
        // Diese Zeile nicht löschen
        parent::ApplyChanges();
	}
	########## private functions ##########
	public function TestMessage() 
	{	
		$this->SendMessage("Test");
	}
	########## public functions ##########


	public function SendMessage(string $message) 
	{
		@curl_setopt_array($ch = curl_init(), array(
			CURLOPT_URL => "https://www.pushsafer.com/api",
			CURLOPT_POSTFIELDS => array(
				"k" => IPS_GetProperty($this->InstanceID,"privatekey"),
				"t" => IPS_GetProperty($this->InstanceID,"title"),
				"d" => IPS_GetProperty($this->InstanceID,"device"),
				"i" => IPS_GetProperty($this->InstanceID,"icon"),
				"s" => IPS_GetProperty($this->InstanceID,"sound"),
				"v" => IPS_GetProperty($this->InstanceID,"vibration"),
				"l" => IPS_GetProperty($this->InstanceID,"time2live"),
				"u" => IPS_GetProperty($this->InstanceID,"url"),
				"ut" => IPS_GetProperty($this->InstanceID,"urltitle"),
				"m" => $message
			),
			CURLOPT_SAFE_UPLOAD => true,
			CURLOPT_RETURNTRANSFER => true
		));
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		if($response === false) {
			IPS_LogMessage("Pushsafer", "Connection Error!");
		} else {
			$result = json_decode($response, 1);
			IPS_LogMessage("Pushsafer", "Send: ".$result['success']." Status: ".$result['status']);
		}		
	}
}
?>
