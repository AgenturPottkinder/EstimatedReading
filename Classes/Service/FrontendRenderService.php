<?php
namespace Pottkinder\Estimatedreading\Service;

/**
 * Service Class to modify Content after rendering
 */
class FrontendRenderService
{

    /**
     * Update cache content from FrontendRenderer
     * hook is called after Caching!
     * => for modification of pages with COA_/USER_INT objects.
     *
     * @param array $parameters
     */
    public static function updateUncachedContent(&$parameters)
    {
        self::updateContent($parameters, true);
    }

    /**
     * Update Clean cache content from FrontendRenderer
     * hook is called before Caching!
     * => for modification of pages on their way in the cache.
     *
     * @param array $parameters
     */
    public static function updateCachedContent(&$parameters)
    {
        self::updateContent($parameters, false);
    }

    /**
     * Update Content for both cached and uncached.
     *
     * @param array $parameters
     * @param bool $unCached to decided if cached or uncached should be replaced
     */
    protected static function updateContent(&$parameters, $unCached = true)
    {
        $tsfe = &$parameters['pObj'];
        if ($tsfe instanceof \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController) {
            if ($tsfe->isINTincScript() === $unCached) {
                self::replace($tsfe->content);
            }
        }
    }

    /**
     * function replace
     * Replaces all placeholders in Content
     *
     * @param string $content
     */
    protected static function replace(&$content)
    {
        $replacementArray = \Pottkinder\Estimatedreading\Service\EstimateReadingService::getReplacementArray();
        $content = str_replace($replacementArray['search'], $replacementArray['replace'], $content);
    }
}
