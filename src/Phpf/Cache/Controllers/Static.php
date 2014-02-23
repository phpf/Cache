<?php

namespace Phpf\Cache;

class StaticController extends AbstractController {
		
	protected $cache = array();
	
	public function getEngine(){
		return 'static';
	}
	
	public function getPrefix( $group = self::DEFAULT_GROUP ){
		return $group;
	}
	
	public function exists( $id, $group = self::DEFAULT_GROUP ){
		return isset( $this->cache[ $group ][ $id ] );
	}
	
	public function get( $id, $group = self::DEFAULT_GROUP ){
		if ( ! empty($this->cache[$group]) && $this->exists($id, $group) )
			return maybe_unserialize( $this->cache[ $group ][ $id ] );
	}
	
	public function set( $id, $value, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL ){
		$this->cache[ $group ][ $id ] = maybe_serialize($value);
	}
	
	public function delete( $id, $group = self::DEFAULT_GROUP ){
		unset( $this->cache[ $group ][ $id ] );
	}
	
	public function incr( $id, $val = 1, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL ){
		$this->cache[ $group ][ $id ] += $val;
	}

	public function decr( $id, $val = 1, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL ){
		$this->cache[ $group ][ $id ] -= $val;
	}
	
	public function flush(){
		unset( $this->cache );
	}

	public function flushGroup( $group ){
		unset( $this->cache[ $group ] );
	}

}
