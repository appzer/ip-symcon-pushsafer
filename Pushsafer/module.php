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
	private $priority = "";
	private $retry = "";
	private $expire = "";
	private $answer = "";
	private $url = "";
	private $urltitle = "";
	private $image1 = "";
	private $image2 = "";
	private $image3 = "";
	    
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
		$this->RegisterPropertyString("priority", "0");
		$this->RegisterPropertyString("retry", "");
		$this->RegisterPropertyString("expire", "");
		$this->RegisterPropertyString("answer", "");
		$this->RegisterPropertyString("url", "https://www.pushsafer.com");
		$this->RegisterPropertyString("urltitle", "Open Pushsafer.com");
		$this->RegisterPropertyString("image1", "");
		$this->RegisterPropertyString("image2", "");
		$this->RegisterPropertyString("image3", "");
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
		if(IPS_GetProperty($this->InstanceID,"image1")!=''){
			$image1 = file_get_contents(IPS_GetProperty($this->InstanceID,"image1"));
			if ($image1 !== false){
				$imgtype1 = strtolower(substr(IPS_GetProperty($this->InstanceID,"image1"), -3));
				if($imgtype1!='jpg' && $imgtype1!='png' && $imgtype1!='gif'){
					$imgtype1='jpg';
				}
				$image1 = 'data:image/'.$imgtype1.';base64,'.base64_encode($image1);
			}
		}
		if(IPS_GetProperty($this->InstanceID,"image2")!=''){
			$image2 = file_get_contents(IPS_GetProperty($this->InstanceID,"image2"));
			if ($image2 !== false){
				$imgtype2 = strtolower(substr(IPS_GetProperty($this->InstanceID,"image2"), -3));
				if($imgtype2!='jpg' && $imgtype2!='png' && $imgtype2!='gif'){
					$imgtype2='jpg';
				}			
				$image2 = 'data:image/'.$imgtype2.';base64,'.base64_encode($image2);
			}
		}
		if(IPS_GetProperty($this->InstanceID,"image3")!=''){
			$image3 = file_get_contents(IPS_GetProperty($this->InstanceID,"image3"));
			if ($image3 !== false){
				$imgtype3 = strtolower(substr(IPS_GetProperty($this->InstanceID,"image3"), -3));
				if($imgtype3!='jpg' && $imgtype3!='png' && $imgtype3!='gif'){
					$imgtype3='jpg';
				}			
				$image3 = 'data:image/'.$imgtype3.';base64,'.base64_encode($image3);
			}
		}
	
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
				"pr" => IPS_GetProperty($this->InstanceID,"priority"),
				"re" => IPS_GetProperty($this->InstanceID,"retry"),
				"ex" => IPS_GetProperty($this->InstanceID,"expire"),
				"a" => IPS_GetProperty($this->InstanceID,"answer"),
				"u" => IPS_GetProperty($this->InstanceID,"url"),
				"ut" => IPS_GetProperty($this->InstanceID,"urltitle"),
				"p" => $image1,
				"p2" => $image2,
				"p3" => $image3,
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
