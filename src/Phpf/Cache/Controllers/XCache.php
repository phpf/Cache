<?php

namespace Phpf\Cache;

class XCache extends AbstractController {
	
	protected static $_instance;
	
	public function getEngine(){
		return 'xcache';	
	}
	
	public function getPrefix( $group = self::DEFAULT_GROUP ){
		
		return $this->prefix . $group . '|';
	}
	
	public function exists( $id, $group = self::DEFAULT_GROUP ){
		
		return xcache_isset( $this->getPrefix($group) . $id );	
	}
	
	public function getGroup( $group = self::DEFAULT_GROUP ){
		return xcache_get( $this->getPrefix($group) );
	}
	
	public function get( $id, $group = self::DEFAULT_GROUP ){
		
		$value = xcache_get( $this->getPrefix($group) . $id );	
		
		if ( is_serialized($value) ){
			$unserializer = $this->unserializer;
			$value = $unserializer($value);
		}
		
		return $value;
	}
		
	public function set( $id, $value, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL ){
		
		if ( is_object($value) ){
			$serializer = $this->serializer;
			$value = $serializer($value);
		}
		
		return xcache_set( $this->getPrefix($group) . $id, $value, $ttl );		
	}
			
	public function delete( $id, $group = self::DEFAULT_GROUP ){
		
		return xcache_unset( $this->getPrefix($group) . $id );	
	}
	
	public function incr( $id, $val = 1, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL ){
		
		return xcache_inc( $this->getPrefix($group) . $id, $val, $ttl );	
	}
	
	public function decr( $id, $val = 1, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL ){
		
		return xcache_dec( $this->getPrefix($group) . $id, $val, $ttl );	
	}
	
	public function flush(){
		
		return xcache_unset_by_prefix($this->prefix);
	}
	
	public function flushGroup( $group ){
		
		return xcache_unset_by_prefix( $this->getPrefix($group) );
	}
		
}