<?php
defined('TYPO3') or die('Access denied.');
/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['demo_sitepackage'] = 'EXT:demo_sitepackage/Configuration/RTE/Default.yaml';

/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:demo_sitepackage/Configuration/TsConfig/Page/All.tsconfig">');

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'DemoSitepackage',
        'List',
        [
            \Mbigha\DemoSitepackage\Controller\UserController::class => 'list'
        ],
        // non-cacheable actions
        [
            \Mbigha\DemoSitepackage\Controller\UserController::class => ''
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    list {
                        iconIdentifier = demo_sitepackage-plugin-list
                        title = LLL:EXT:demo_sitepackage/Resources/Private/Language/locallang_db.xlf:tx_demo_sitepackage_list.name
                        description = LLL:EXT:demo_sitepackage/Resources/Private/Language/locallang_db.xlf:tx_demo_sitepackage_list.description
                        tt_content_defValues {
                            CType = list
                            list_type = demositepackage_list
                        }
                    }
                }
                show = *
            }
       }'
    );
})();