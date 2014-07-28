<?php
	class FloatValidator implements IValidator{

		private $generalErrorMessages = array( 
								  			  'INVALID_FORMAT' => 'The value is not in a float format!',
				  				  			 );

		private $returnMessages = array();

		public function isValid($value){
			if (filter_var($value, FILTER_VALIDATE_FLOAT)){
				return true;
			}
			$this->setMessage($this->generalErrorMessages['INVALID_FORMAT']);
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