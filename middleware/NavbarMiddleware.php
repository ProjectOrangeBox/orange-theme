<?php 

class NavbarMiddleware {
	public static function request() {
		ci('event')->register('nav_library.html',function(&$html){
			$html = str_replace('{username}',user::username(),$html);
			$html = str_replace('{email}',user::email(),$html);
		});
	}
}
