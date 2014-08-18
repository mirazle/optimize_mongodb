<?php

/* All collection repair and compact */

MongoCursor::$timeout = -1;

$mongo		= new Mongo;
$dbs		= $mongo->listDBs();

foreach( $dbs['databases'] as $index=>$db ){

	$db			= $mongo->{ $db['name'] };
	$db->repair();
	$collection_list	= $db->listCollections();

	foreach ( $collection_list as $co_cnt=>$collection ) {

		$collection_arr		= explode( '.', $collection );

		$collection_name	= $collection_arr[1];

		$db->execute( 'db.' . $collection_name . '.compact' );
	}
}

?>
