<?php
namespace Pottkinder\Estimatedreading\Service;

use Pottkinder\Estimatedreading\Model\StringGroup;

/**
 * Service Model for EstimatedReading StringGroups
 */
class EstimateReadingService
{
    /**
     * function getKeywordStringGroup
     *
     * @param string $keyword
     * @return StringGroup
     */
    public static function getKeywordStringGroup(string $keyword)
    {
        $keyword = self::validateKeyword($keyword);
        if(!isset($GLOBALS['EXT']['estimatedreading']['stringgroup'][$keyword]))
        {
            return new StringGroup("");
        } else {
            return $GLOBALS['EXT']['estimatedreading']['stringgroup'][$keyword];
        }
    }

    /**
     * function addStringToKeyword
     *
     * @param string $keyword
     * @param string $string
     * @return void
     */
    public static function addStringToKeyword(string $keyword, string $string)
    {
        $keyword = self::validateKeyword($keyword);
        if(!isset($GLOBALS['EXT']['estimatedreading']['stringgroup'][$keyword]))
        {
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
        $keyword = preg_replace("/[^0-9a-zA-Z-_]/", '', $keyword);
        $keyword = trim($keyword);
        if(strlen($keyword) === 0)
        {
            throw new \InvalidArgumentException("Keyword for estimated Reading should never be empty");
        }
        if($orgKeyword != $keyword)
        {
            throw new \InvalidArgumentException("Keyword for estimated Reading should not contain special chars. Please use only 0-9 a-zA-Z and -_");
        }
        return $keyword;
    }
}