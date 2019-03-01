<?php

class NavbarMiddleware extends \Middleware_base
{
	public function request() : void
	{
		$this->event->register('nav_library.html', function (&$html) {
			$html = str_replace('{username}', $this->user->username, $html);
			$html = str_replace('{email}', $this->user->email, $html);
		});
	}
}
