<?php
if (!defined("TYPO3_MODE")) {
    die("Access denied.");
}

/**
 * Hook for HTML-modification on the page
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = \Pottkinder\Estimatedreading\Service\FrontendRenderService::updateUncachedContent();
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][] = \Pottkinder\Estimatedreading\Service\FrontendRenderService::updateCachedContent();
