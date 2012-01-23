<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_blogger_domain_model_post'] = array(
	'ctrl' => $TCA['tx_blogger_domain_model_post']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, publish_date, author, category, content',
	),
	'types' => array(
		'1' => array('showitem' => 'title, content, --div--;Configuration, publish_date;;1, author, category, tags, related_posts, --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime, sys_language_uid, l10n_parent, l10n_diffsource, hidden'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'sticky'),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_blogger_domain_model_post',
				'foreign_table_where' => 'AND tx_blogger_domain_model_post.pid=###CURRENT_PID### AND tx_blogger_domain_model_post.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
				'default' => true,
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'publish_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.publish_date',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'sticky' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.sticky',
			'config' => array(
				'type' => 'check',
				'default' => 0,
			),
		),
		'author' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.author',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'be_users',
				'minitems' => 0,
				'maxitems' => 1,
				'items' => array(
					array('', '')
				)
			),
		),
		'category' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.category',
			'config' => array(
				'type' => 'select',
				'renderMode' => 'tree',
				'foreign_table' => 'tx_blogger_domain_model_category',
				'foreign_table_where' => ' AND tx_blogger_domain_model_category.pid = ###CURRENT_PID### ORDER BY tx_blogger_domain_model_category.sorting',
				'treeConfig' => array(
					'parentField' => 'parent',
					'appearance' => array(
						'expandAll' => TRUE,
						'showHeader' => TRUE,
					),
				),
				'size' => 10,
				'autoSizeMax' => 20,
				'minitems' => 0,
				'maxitems' => 20,
			),
		),
		'content' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.content',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tt_content',
				'maxitems' => 9999,
				'multiple' => true,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
				#'showSynchronizationLink' => 1,
				#'showPossibleLocalizationRecords' => 1,
				#'showAllLocalizationLink' => 1
				),
			),
		),
		'related_posts' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.related_posts',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_blogger_domain_model_post',
				'multiple' => 0,
				'foreign_table' => 'tx_blogger_domain_model_post',
				'size' => 3,
				'maxitems' => 99,
				'wizards' => array(
					'suggest' => array(    
            			'type' => 'suggest',
        			),
				),
			),
		),
		'tags' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.content',
			'config' => Tx_Tagger_Service_IntegrationService::getTagFieldConfiguration('tx_blogger_domain_model_post'),
		),
	),
);
?>