<?php
namespace Pottkinder\Estimatedreading\Service;

use Pottkinder\Estimatedreading\Model\StringGroup;

/**
 * Service Model for EstimatedReading StringGroups
 */
class EstimateReadingService
{

    /**
     * Array for methodNames of Class StringGroup
     * @var array
     */
    protected static $methodNames = [];

    /**
     * function getKeywordStringGroup
     *
     * @param string $keyword
     * @return StringGroup
     */
    public static function getKeywordStringGroup(string $keyword)
    {
        $keyword = self::validateKeyword($keyword);
        if (!isset($GLOBALS['EXT']['estimatedreading']['stringgroup'][$keyword])) {
            return new StringGroup('');
        } else {
            return $GLOBALS['EXT']['estimatedreading']['stringgroup'][$keyword];
        }
    }

    /**
     * function addStringToKeyword
     *
     * @param string $keyword
     * @param string $string
     */
    public static function addStringToKeyword(string $keyword, string $string)
    {
        $keyword = self::validateKeyword($keyword);
        if (!isset($GLOBALS['EXT']['estimatedreading']['stringgroup'][$keyword])) {
            $GLOBALS['EXT']['estimatedreading']['stringgroup'][$keyword] = new StringGroup($string);
        } else {
            /**
             * @var StringGroup $tmp
             */
            $tmp = $GLOBALS['EXT']['estimatedreading']['stringgroup'][$keyword];
            $tmp->addString($string);
        }
    }

    /**
     * function validateKeyword
     *
     * @param string $keyword
     * @throws \InvalidArgumentException
     * @return string
     */
    public static function validateKeyword(string $keyword)
    {
        $orgKeyword = $keyword;
        $keyword = preg_replace('/[^0-9a-zA-Z-_]/', '', $keyword);
        $keyword = trim($keyword);
        if (strlen($keyword) === 0) {
            throw new \InvalidArgumentException('Keyword for estimated Reading should never be empty');
        }
        if ($orgKeyword != $keyword) {
            throw new \InvalidArgumentException('Keyword for estimated Reading should not contain special chars. Please use only 0-9 a-zA-Z and -_');
        }
        return $keyword;
    }

    /**
     * function getReplacementArray
     * builds replacement Array for FrontendRenderService
     *
     * @return array
     */
    public static function getReplacementArray()
    {
        $return = [
            'search' => [],
            'replace' => []
        ];
        foreach ($GLOBALS['EXT']['estimatedreading']['stringgroup'] as $stringGroupTitle => $stringGroupContent) {
            $stringGroupCalculated = self::buildReplaceValues($stringGroupContent);
            foreach ($stringGroupCalculated as $stringGroupCalculatedTitle => $stringGroupCalulatedValue) {
                $return['search'][] = '###pkEstimateReading_' . $stringGroupTitle . '_' . $stringGroupCalculatedTitle . '###';
                $return['replace'][] = $stringGroupCalulatedValue;
            }
        }
        return $return;
    }

    /**
     * function buildReplaceValues
     * Generates an array with all Getters from StringGroup associated with it's value
     *
     * @param \Pottkinder\Estimatedreading\Model\StringGroup $content
     * @return array
     */
    protected static function buildReplaceValues($content)
    {
        $return = [];
        self::buildMethodNamesIfRequired($content);
        foreach (self::$methodNames as $methodName) {
            $return[$methodName['short']] = call_user_func([$content, $methodName['long']]);
        }
        return $return;
    }

    /**
     * function buildMethodNamesIfRequired
     * Shorts all Get Methods from StringGroup for replacement strings
     *
     * @param \Pottkinder\Estimatedreading\Model\StringGroup $content
     */
    protected static function buildMethodNamesIfRequired($content)
    {
        if (count(self::$methodNames) === 0) {
            $tmpMethodNames = preg_grep('/^get/', get_class_methods($content));
            foreach ($tmpMethodNames as $methodName) {
                self::$methodNames[] = [
                    'short' => lcfirst(substr($methodName, 3)),
                    'long' => $methodName
                ];
            }
        }
    }
}
