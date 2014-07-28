<?php
	class EmailValidator implements IValidator{

		private $generalErrorMessages = array( 'INVALID' => 'The e-mail address must be a string!',
								  			  'INVALID_FORMAT' => 'The e-mail address you entered is not in a correct format!',
								  			 );

		private $returnMessages = array();

		public function isValid($value){
			if (!is_string($value)){
				$this->setMessage($this->generalErrorMessages['INVALID']);
				return false;
			}

			if (!$this->splitEmailParts($value)) {
				$this->setMessage($this->generalErrorMessages['INVALID_FORMAT']);
				return false;
			}
			return true;
		}

		protected function splitEmailParts($value)
	    {
	        // Split email address up and disallow '..'
	        if (is_string($value)){
		        if (filter_var($value, FILTER_VALIDATE_EMAIL)){
		        	return true;
		        }
		    }
		    return false;
		    
	    }

		private function setMessage($message){
			array_push($this->returnMessages, $message);
		}

		public function getMessages(){
			return $this->returnMessages;			
		}
		
	}
?>