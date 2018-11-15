<?php
/**
 * iCalendar plugin for Craft CMS 3.x
 *
 * Ensures that text conforms to the RFC 2445 iCalendar specification
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2018 nystudio107
 */

namespace nystudio107\icalendar\twigextensions;

use nystudio107\icalendar\ICalendar;

/**
 * @author    nystudio107
 * @package   ICalendar
 * @since     1.0.0
 */
class ICalendarTwigExtension extends \Twig_Extension
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
            new \Twig_SimpleFilter('rfc2445', [ICalendar::$plugin->convert, 'rfc2445']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('rfc2445', [ICalendar::$plugin->convert, 'rfc2445']),
        ];
    }
}
