<?php
	interface ICustomInject{
	
		/*Adds a new resolver to the registry array
		* param  string $name The id
		* @param  object $resolve Closure that creates instance
		* returns nothing
		*/
		static function register($name, Closure $resolve);
		
		/**
		 * Create the instance
		 * @param  string $name The id
		 * @return mixed
		 */
		static function resolve($name);
	}
?>