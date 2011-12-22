<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'piBlog',
	array(
		'Blog' => 'list,detail'
	),
	// non-cacheable actions
	array(
		'Blog' => 'list'
	)
);

?>