<?php
namespace Pottkinder\Estimatedreading\Service;

/**
 * Service model for string work
 */
class StringService
{
    /**
     * function fetchStatistics
     * Gets HTML and returns only the numbers about it.
     *
     * @return string $string
     */
    public static function fetchStatistics(string $string)
    {
        $string = self::removeHTML($string);
        return [
            'words' => self::getWordCount($string),
            'chars' => self::getChars($string),
            'charsWithoutSpaces' => self::getCharsWithoutSpaces($string),
            'sentences' => self::getWordCount($string)
        ];
    }

    /**
     * function getWordCount
     * Returns amount of words for $string
     * Don't forget to run self::removeHTML before using this.
     *
     * @param string $string
     */
    public static function getWordCount(string $string)
    {
        return count(preg_split('/\s+/', $string));
    }

    /**
     * function getSentences
     * Returns sentences counting
     * Don't forget to run self::removeHTML before using this.
     *
     * @param string $string
     * @return int
     */
    public static function getSentences(string $string)
    {
        return preg_match_all('/([^\.\!\?]+[\.\?\!]*)/', $string, $match);
    }

    /**
     * function removeHTML
     * Removes all tags from given String
     *
     * @param string $string
     * @return string
     */
    public static function removeHTML(string $string)
    {
        return strip_tags($string);
    }

    /**
     * function getChars
     * Returns amount of chars for $string
     * Don't forget to run self::removeHTML before using this.
     *
     * @param string $string
     * @return int
     */
    public static function getChars(string $string)
    {
        return strlen($string);
    }

    /**
     * function getCharsWithoutSpaces
     * Returns amount of chars for $string without all whitespaces
     * Don't forget to run self::removeHTML before using this.
     *
     * @param string $string
     * @return int
     */
    public static function getCharsWithoutSpaces(string $string)
    {
        return strlen(preg_replace('/\s/', '', $string));
    }
}
