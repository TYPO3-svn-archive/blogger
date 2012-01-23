<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
		$_EXTKEY, 'piBlog', 'Blog'
);

Tx_Extbase_Utility_Extension::registerPlugin(
		$_EXTKEY, 'piBlogWidget', 'Widget'
);

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_piblog'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_piblog', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/PiBlog.xml');

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_piblogwidget'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_piblogwidget', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/PiBlogWidget.xml');

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Blog');

t3lib_extMgm::addLLrefForTCAdescr('tx_blogger_domain_model_post', 'EXT:blogger/Resources/Private/Language/locallang_csh_tx_blogger_domain_model_post.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_blogger_domain_model_post');
$TCA['tx_blogger_domain_model_post'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY sticky DESC, publish_date DESC',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'groupName' => 'blogger',
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Post.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/Post.png'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_blogger_domain_model_category', 'EXT:blogger/Resources/Private/Language/locallang_csh_tx_blogger_domain_model_category.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_blogger_domain_model_category');
$TCA['tx_blogger_domain_model_category'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_category',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'sortby' => 'sorting',
		'groupName' => 'blogger',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/Category.png'
	),
);

if (TYPO3_MODE == 'BE') {
	unset($ICON_TYPES['blogger']);
	$TCA['pages']['columns']['module']['config']['items'][] = array('Blogger', 'blogger');
	t3lib_SpriteManager::addTcaTypeIcon('pages', 'blogger', '../typo3conf/ext/blogger/Resources/Public/Icons/Post.png');
}
?>