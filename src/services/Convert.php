<?php
/**
 * iCalendar plugin for Craft CMS 3.x
 *
 * Tools for parsing & formatting the RFC 2445 iCalendar (.ics) specification
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2018 nystudio107
 */

namespace nystudio107\icalendar\services;

use craft\helpers\Template;

use craft\base\Component;

/**
 * @author    nystudio107
 * @package   ICalendar
 * @since     1.0.0
 */
class Convert extends Component
{
    // Constants
    // =========================================================================

    const RFC2455_EOL = "\r\n";
    const MAX_OCTETS = 75;

    // Public Methods
    // =========================================================================

    /**
     * Format the passed in $text as per the iCalendar RFC 2445 spec:
     * https://icalendar.org/validator.html
     *
     * @param string $text
     *
     * @return string
     */
    public function rfc2445(string $text): string
    {
        $result = '';
        // Normalize the line breaks
        $text = str_replace(["\n", "\r\r\n"], self::RFC2455_EOL, $text);
        // Split the text into separate lines
        $lines = explode(self::RFC2455_EOL, $text);
        foreach ($lines as $line) {
            $result .= $this->icalSplit('', $line) . self::RFC2455_EOL;
        }
        return Template::raw($result);
    }

    // Protected Methods
    // =========================================================================

    /**
     * Split the lines into RFC 2445 compatible line breaks so that no line
     * is longer than 75 octets
     * Adapted from: https://gist.github.com/hugowetterberg/81747
     *
     * @param $preamble
     * @param $value
     *
     * @return string
     */
    protected function icalSplit(string $preamble, string $value): string
    {
        $value = trim($value);
        $value = strip_tags($value);
        $value = preg_replace('/\n+/', ' ', $value);
        $value = preg_replace('/\s{2,}/', ' ', $value);
        $preamble_len = \strlen($preamble);
        $lines = [];
        while (\strlen($value) > (self::MAX_OCTETS - $preamble_len)) {
            $space = (self::MAX_OCTETS - $preamble_len);
            $mbcc = $space;
            while ($mbcc) {
                $line = mb_substr($value, 0, $mbcc);
                $oct = \strlen($line);
                if ($oct > $space) {
                    $mbcc -= $oct - $space;
                } else {
                    $lines[] = $line;
                    $preamble_len = 1; // Still take the tab into account
                    $value = mb_substr($value, $mbcc);
                    break;
                }
            }
        }
        if (!empty($value)) {
            $lines[] = $value;
        }

        return implode($lines);
    }
}
