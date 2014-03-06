<?php

namespace Phpf\Cache\Service;

use Phpf\Cache\Cache;

class Provider implements \Phpf\Service\Provider {
	
	public function provide(){
		
		if ( function_exists('xcache_get') ){
			$driver = new \Phpf\Cache\Driver\XCacheDriver;
		} else {
			$driver = new \Phpf\Cache\Driver\StaticDriver;
		}
		
		$cache = Cache::instance();
		$cache->setDriver($driver);
	}
	
	public function isProvided(){
		return true;
	}
	
}
