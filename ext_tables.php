<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'piBlog',
	'Blog'
);

//$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . blog;
//$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .blog. '.xml');






t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Blog');


t3lib_extMgm::addLLrefForTCAdescr('tx_blogger_domain_model_post', 'EXT:blogger/Resources/Private/Language/locallang_csh_tx_blogger_domain_model_post.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_blogger_domain_model_post');
$TCA['tx_blogger_domain_model_post'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY publish_date DESC',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
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
		'title'	=> 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_category',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/Category.png'
	),
);
?>