<?php

namespace Phpf\Cache;

abstract class AbstractController {
	
	const DEFAULT_TTL = 1800; // 3 hrs
	
	const DEFAULT_GROUP = 'default';
	
	protected $engine;
	
	protected $prefix;
	
	protected $serializer;
	
	protected $unserializer;
	
	protected static $_instance;
	
	final public static function i(){
		if ( ! isset(static::$_instance) )
			static::$_instance = new static();
		return static::$_instance;
	}
	
	final public function __construct(){
		$this->engine = $this->getEngine();
		$this->prefix = defined('CACHE_PREFIX') ? CACHE_PREFIX : md5($_SERVER['HTTP_HOST']) . '|';
		$this->serializer = function_exists('igbinary_serialize') ? 'igbinary_serialize' : 'serialize';
		$this->unserializer = function_exists('igbinary_unserialize') ? 'igbinary_unserialize' : 'unserialize';
	}
	
	abstract public function getEngine();
	
	abstract public function getPrefix( $group = self::DEFAULT_GROUP );
	
	abstract public function exists( $id, $group = self::DEFAULT_GROUP );
	
	abstract public function get( $id, $group = self::DEFAULT_GROUP );
		
	abstract public function set( $id, $value, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL );
		
	abstract public function delete( $id, $group = self::DEFAULT_GROUP );
	
	abstract public function incr( $id, $val = 1, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL );
	
	abstract public function decr( $id, $val = 1, $group = self::DEFAULT_GROUP, $ttl = self::DEFAULT_TTL );
	
	abstract public function flush();
	
	abstract public function flushGroup( $group );
	
}