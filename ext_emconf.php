<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "searchindexupdater".
 *
 * Auto generated 12-09-2014 15:49
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Indexed Search Updater',
	'description' => 'Updates the search index of EXT:indexed_search after create/edit/delete actions on pages.',
	'category' => 'be',
	'author' => 'Gregor Doroschenko',
	'author_email' => 'doroschenko@webit.de',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => 'webit! Gesellschaft für neue Medien mbH',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-4.5.99',
			'indexed_search' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

?>