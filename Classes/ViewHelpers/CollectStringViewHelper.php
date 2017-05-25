<?php
namespace Pottkinder\Estimatedreading\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ViewHelper to collect informations about the substring
 *
 * # Example: Basic example
 * <code>
 * <p:CollectString keyword="myKeyword">The normal Output</p:CollectString>
 * </code>
 * <output>
 * The normal Output
 * </output>
 *
 */
class CollectStringViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('keyword', 'string', 'Keyword to Manage multiple EstimatedReadings', true, 'default');
    }

    /**
     * function render
     *
     * @return string
     */
    public function render()
    {
        $string = $this->renderChildren();
        \Pottkinder\Estimatedreading\Service\EstimateReadingService::addStringToKeyword($arguments['keyword'], $string);
        return $string;
    }
}
