<?php

/*	FUNCTION(役割)
*/

/******************************************/
/*	REQUIRE
/******************************************/

MongoCursor::$timeout = -1;

$mongo		= new Mongo;
$dbs		= $mongo->listDBs();

foreach( $dbs['databases'] as $index=>$db ){

	// DB取得
	$db					= $mongo->{ $db['name'] };

	// db.repairDatabase();
	$db->repair();

	$collection_list	= $db->listCollections();

	// コレクションリストをループでまわす
	foreach ( $collection_list as $co_cnt=>$collection ) {

		// DB名とコレクション名を切り離す
		$collection_arr		= explode( '.', $collection );

		// コレクション名を取得
		$collection_name	= $collection_arr[1];

		// compact(indexの最適化 & デフラグ)
		$db->execute( 'db.' . $collection_name . '.compact' );
	}
}

?>
