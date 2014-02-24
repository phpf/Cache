<?php

namespace Phpf\Cache\Service;

class Provider implements \Phpf\Service\Provider {
	
	public function provide(){
		
		$base = dirname(__DIR__);		
		
		require $base . '/Controllers/Abstract.php';	
		
		if ( function_exists('xcache_get') ){
			require $base . '/Controllers/XCache.php';
			class_alias( 'Phpf\Cache\XCache', 'Cache' );
	//	} elseif ( function_exists('apc_fetch') ){
			// use APC...
		} else {
			require $base . '/Controllers/Static.php';
			class_alias( 'Phpf\Cache\StaticController', 'Cache' );
		}
		
		\Cache::i();
	}
	
	public function isProvided(){
		return class_exists('Cache', false);
	}
	
}
