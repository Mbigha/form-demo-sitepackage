<?php
defined('TYPO3') || die();

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_demositepackage_fe_users = [];
    $tempColumnstx_demositepackage_fe_users[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = [
        'exclude' => true,
        'label' => 'LLL:EXT:demo_sitepackage/Resources/Private/Language/locallang_db.xlf:tx_demositepackage.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', ''],
                ['User', 'Tx_DemoSitepackage_User']
            ],
            'default' => 'Tx_DemoSitepackage_User',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumnstx_demositepackage_fe_users);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $GLOBALS['TCA']['fe_users']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['fe_users']['ctrl']['label']
);

$tmp_demo_sitepackage_columns = [

    'first_name' => [
        'exclude' => true,
        'label' => 'LLL:EXT:demo_sitepackage/Resources/Private/Language/locallang_db.xlf:tx_demositepackage_domain_model_user.first_name',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'last_name' => [
        'exclude' => true,
        'label' => 'LLL:EXT:demo_sitepackage/Resources/Private/Language/locallang_db.xlf:tx_demositepackage_domain_model_user.last_name',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'image' => [
        'exclude' => true,
        'label' => 'LLL:EXT:demo_sitepackage/Resources/Private/Language/locallang_db.xlf:tx_demositepackage_domain_model_user.image',
        'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
            'image',
            [
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                ],
                'foreign_types' => [
                    '0' => [
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette'
                    ]
                ],
                'foreign_match_fields' => [
                    'fieldname' => 'image',
                    'tablenames' => 'fe_users',
                    'table_local' => 'sys_file',
                ],
                'maxitems' => 1
            ],
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
        ),

    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_demo_sitepackage_columns);

// inherit and extend the show items from the parent class
if (isset($GLOBALS['TCA']['fe_users']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['fe_users']['types']['Tx_DemoSitepackage_User']['showitem'] = $GLOBALS['TCA']['fe_users']['types']['0']['showitem'];
} elseif (is_array($GLOBALS['TCA']['fe_users']['types'])) {
    // use first entry in types array
    $fe_users_type_definition = reset($GLOBALS['TCA']['fe_users']['types']);
    $GLOBALS['TCA']['fe_users']['types']['Tx_DemoSitepackage_User']['showitem'] = $fe_users_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['fe_users']['types']['Tx_DemoSitepackage_User']['showitem'] = '';
}
$GLOBALS['TCA']['fe_users']['types']['Tx_DemoSitepackage_User']['showitem'] .= ',--div--;LLL:EXT:demo_sitepackage/Resources/Private/Language/locallang_db.xlf:tx_demositepackage_domain_model_user,';
$GLOBALS['TCA']['fe_users']['types']['Tx_DemoSitepackage_User']['showitem'] .= 'first_name, last_name, image';

$GLOBALS['TCA']['fe_users']['columns'][$GLOBALS['TCA']['fe_users']['ctrl']['type']]['config']['items'][] = [
    'LLL:EXT:demo_sitepackage/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_DemoSitepackage_User',
    'Tx_DemoSitepackage_User'
];
