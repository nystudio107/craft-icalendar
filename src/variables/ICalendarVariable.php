<?php
/**
 * iCalendar plugin for Craft CMS 3.x
 *
 * Tools for parsing & formatting the RFC 2445 iCalendar (.ics) specification
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2019 nystudio107
 */

namespace nystudio107\icalendar\variables;

use craft\helpers\Template;

use ICal\ICal;

use nystudio107\icalendar\ICalendar;

use Twig\Markup;

/**
 * @author    nystudio107
 * @package   ICalendar
 * @since     1.1.0
 */
class ICalendarVariable
{
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
    public function rfc2445(string $text): Markup
    {
        return Template::raw(ICalendar::$plugin->convert->rfc2445($text));
    }

    /**
     * Return the ICal object (or null) for the events feed
     *
     * @param mixed|array|string $files
     * @param array              $config
     *
     * @return null|ICal
     */
    public function ics($files, array $config = [])
    {
        return ICalendar::$plugin->parse->ics($files, $config);
    }
}
