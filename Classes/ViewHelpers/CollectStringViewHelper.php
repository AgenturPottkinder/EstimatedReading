<?php
namespace Pottkinder\Estimatedreading\ViewHelpers;

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
 */
class CollectStringViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @var bool
     */
    protected $escapeChildren = false;

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
        \Pottkinder\Estimatedreading\Service\EstimateReadingService::addStringToKeyword($this->arguments['keyword'], $string);
        return $string;
    }
}
