<?php
/**
* @package Phpf.Cache
*/
 
require __DIR__ . '/Controllers/Abstract.php';	

if ( function_exists('xcache_get') ){
	require __DIR__ . '/Controllers/XCache.php';
	class_alias( 'Phpf\Cache\XCache', 'Cache' );
} elseif ( function_exists('apc_fetch') ){
	// use APC...
} else {
	require __DIR__ . '/Controllers/Static.php';
	class_alias( 'Phpf\Cache\StaticController', 'Cache' );
}

Cache::i();
	
function cache_get( $id, $group = Cache::DEFAULT_GROUP ){
	return Cache::i()->get( $id, $group );	
}

function cache_set( $id, $value, $group = Cache::DEFAULT_GROUP, $ttl = Cache::DEFAULT_TTL ){
	return Cache::i()->set( $id, $value, $group, $ttl );
}

function cache_isset( $id, $group = Cache::DEFAULT_GROUP ){
	return Cache::i()->exists( $id, $group );	
}

function cache_unset( $id, $group = Cache::DEFAULT_GROUP ){
	return Cache::i()->delete( $id, $group );	
}

function cache_delete( $id, $group = Cache::DEFAULT_GROUP ){
	return Cache::i()->delete( $id, $group );	
}

function cache_incr( $id, $value = 1, $group = Cache::DEFAULT_GROUP, $ttl = Cache::DEFAULT_TTL ){
	return Cache::i()->incr( $id, $group );	
}

function cache_decr( $id, $value = 1, $group = Cache::DEFAULT_GROUP, $ttl = Cache::DEFAULT_TTL ){
	return Cache::i()->decr( $id, $group );	
}

function cache_flush_group( $group ){
	return Cache::i()->flushGroup( $group );	
}

function cache_flush( $group = null ){
	if ( !empty( $group ) )
		return Cache::i()->flushGroup($group);
	return Cache::i()->flush();	
}

