<?
    class Pushsafer extends IPSModule {
 
        public function __construct($InstanceID) {
            parent::__construct($InstanceID);
         }
 
        public function Create() {
            parent::Create();
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
 
        public function ApplyChanges() {
            parent::ApplyChanges();
        }
 
        public function SendAlert($message) {
            $POST_Para["k"] = $this->ReadPropertyString("privatekey");
			$POST_Para["m"] = $message;
			$POST_Para["t"] = $this->ReadPropertyString("title");
			$POST_Para["d"] = $this->ReadPropertyString("device");
			$POST_Para["i"] = $this->ReadPropertyString("icon");
			$POST_Para["s"] = $this->ReadPropertyString("sound");
			$POST_Para["v"] = $this->ReadPropertyString("vibration");
			$POST_Para["l"] = $this->ReadPropertyString("time2live");
			$POST_Para["u"] = $this->ReadPropertyString("url");
			$POST_Para["ut"] = $this->ReadPropertyString("urltitle");
			APIRequest($POST_Para);
        }
		
		private function APIRequest($POST_Para) {
			curl_setopt_array($ch = curl_init(), array(
				CURLOPT_URL => "https://www.pushsafer.com/api",
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => true,
				CURLOPT_HTTPHEADER => array('Content-type: application/x-www-form-urlencoded'),
				CURLOPT_POSTFIELDS => $POST_Para,
			));
			$response = curl_exec($ch);
			curl_close($ch);
			if($response === false) {
				IPS_LogMessage("Pushsafer", "Connection Error!");
			} else {
				list($header, $body) = explode("\r\n\r\n", $response, 2);
				//echo $header."\r\n";
				//echo "**".$body."**\r\n";
				$result = json_decode($body, 1);
				(isset($result['success'])) ? $success = $result['success'] : $success = null;
				(isset($result['status'])) ? $status = $result['status'] : $status = null;
				(isset($result['available'])) ? $available = $result['available'] : $available = null;
	
				//echo $success." : ".$status." : ".$available;
				IPS_LogMessage("Pushsafer", "Send : ".$success." : ".$status." : ".$available);
			}
		}
    }
?>