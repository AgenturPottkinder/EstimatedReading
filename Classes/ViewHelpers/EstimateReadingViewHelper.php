<?php
namespace Pottkinder\Estimatedreading\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ViewHelper to display informations about given StringGroup
 *
 * # Example: Basic example
 * <code>
 * <p:EstimateReading keyword="myKeyword">{estimateReading.chars} chars</p:EstimateReading>
 * </code>
 * <output>
 * 1234 chars
 * </output>
 *
 */
class EstimateReadingViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
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
     * @return \string
     */
    public function render()
    {
        $stringGroup = \Pottkinder\Estimatedreading\Service\EstimateReadingService::getStringGroup($arguments['keyword']);
        $this->renderingContext->getVariableProvider()->add('estimateReading', $stringGroup);
        return $this->renderChildren();
    }
}
