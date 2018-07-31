<?php 

class NavbarMiddleware {
	public static function responds($output) {
		$output = str_replace('{username}',user::username(),$output);
		$output = str_replace('{email}',user::email(),$output);
		
		return $output;
	}
}
