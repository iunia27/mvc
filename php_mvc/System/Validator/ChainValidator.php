<?php
	
	class ChainValidator{
		
		private $messages = array();
		private $validators = array();
		
		/*
		* Attaches a new validator at the end of the queue.
		*/
		public function addValidator(IValidator $validator, $breakChainOnFailure = false){
		
		}

		/*
		* Attaches a new validator at the begining of the queue.
		*/
		public function preAppendValidator(IValidator $validator, $breakChainOnFailure = false){
		
		}
		
		/*
		* Detach a validator based on validator name which represents the associative array key.
		*/
		public function dettachValidator($validatorKeyName){
		
		}
		
		/*
		* Returns all validators attached since then.
		*/
		public function getValidators(){
			return $this->validators;
		}
		
		/*
		* Returns all failure messages.
		*/
		public function getMessages(){
			return $this->messages;
		}
		
		/*
		* Returns true if and only if $value passes all validations in the chain
		*/
		public function isValid($value, $context){
			
		}
		
		/*
		* Return the count of attached validators
		*/
		public function countValidators(){
			return count($this->validators);
		}
		
		private function array_push_assoc($array, $key, $value){
			$array[$key] = $value;
			return $array;
		}
	}
	
?>