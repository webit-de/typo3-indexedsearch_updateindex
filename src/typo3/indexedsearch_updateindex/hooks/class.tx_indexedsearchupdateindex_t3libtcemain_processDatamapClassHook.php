<?php

class tx_indexedsearchupdateindex_t3libtcemain_processDatamapClassHook {

	/**
	 * TCEmain hook function for on-the-fly indexing of database records
	 *
	 * @param	string		Status "new" or "update"
	 * @param	string		Table name
	 * @param	string		Record ID. If new record its a string pointing to index inside t3lib_tcemain::substNEWwithIDs
	 * @param	array		Field array of updated fields in the operation
	 * @param	object		Reference to tcemain calling object
	 * @return	void
	 */
	function processDatamap_afterDatabaseOperations($status, $table, $id, $fieldArray, $pObj) {

		// monitor backend operations and react whenever a page is updated
		// (change page properties or page content)
		if(($status == 'new' || $status == 'update') && $table == 'pages') {
			// Get pHashes of current record
			$pHashesOfGivenPage_result = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('phash','index_section', 'page_id='.intval($id));

			// Count fetched old pHashes
			$cntPHashes = count($pHashesOfGivenPage_result);

			// Create array with old pHashes for deleting
			$deleteFetchedPHashes = array();
			for($i=0; $i<$cntPHashes; $i++) {
				$deleteFetchedPHashes[] = $pHashesOfGivenPage_result[$i]['phash'];
			}

			// Delete old pHashes from index tables
			$where_clausel = 'phash IN ('.implode(',',$GLOBALS['TYPO3_DB']->cleanIntArray($deleteFetchedPHashes)).')';
			$tables_to_clear = explode(',', 'index_section,index_rel,index_phash,index_grlist,index_fulltext,index_fulltext,index_debug');
			foreach ($tables_to_clear as $table) {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery($table, $where_clausel);
			}

			// Run curl process in background to visit the updated page
			$url_to_open = t3lib_div::getIndpEnv('TYPO3_SITE_URL').'index.php?id='.$id; // url for updated record
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url_to_open);
			curl_setopt($curl, CURLOPT_HEADER, false); // don't include HEADER to output
			curl_setopt($curl, CURLOPT_NOBODY, true); // don't include BODY(content) to output
			curl_exec($curl);
			curl_close($curl);
		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/indexedsearch_updateindex/hooks/class.tx_searchindexupdater_t3libtcemain_processDatamapClassHook.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/indexedsearch_updateindex/hooks/class.tx_searchindexupdater_t3libtcemain_processDatamapClassHook.php']);
}

?>