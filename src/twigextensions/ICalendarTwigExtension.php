<?php
/**
 * iCalendar plugin for Craft CMS 3.x
 *
 * Tools for parsing & formatting the RFC 2445 iCalendar (.ics) specification
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2018 nystudio107
 */

namespace nystudio107\icalendar\twigextensions;

use nystudio107\icalendar\ICalendar;

use Twig\Extension\AbstractExtension as TwigExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * @author    nystudio107
 * @package   ICalendar
 * @since     1.0.0
 */
class ICalendarTwigExtension extends TwigExtension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'ICalendar';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new TwigFilter('rfc2445', [ICalendar::$plugin->convert, 'rfc2445']),
            new TwigFilter('parseIcs', [ICalendar::$plugin->parse, 'ics']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('rfc2445', [ICalendar::$plugin->convert, 'rfc2445']),
            new TwigFunction('parseIcs', [ICalendar::$plugin->parse, 'ics']),
        ];
    }
}
