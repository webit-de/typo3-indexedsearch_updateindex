<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

// register hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:indexedsearch_updateindex/hooks/class.tx_indexedsearchupdateindex_t3libtcemain_processDatamapClassHook.php:tx_indexedsearchupdateindex_t3libtcemain_processDatamapClassHook';

?>