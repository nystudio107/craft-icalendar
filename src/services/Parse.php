<?php
/**
 * iCalendar plugin for Craft CMS 3.x
 *
 * Tools for parsing & formatting the RFC 2445 iCalendar (.ics) specification
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2019 nystudio107
 */

namespace nystudio107\icalendar\services;

use craft\base\Component;

use ICal\ICal;

/**
 * @author    nystudio107
 * @package   ICalendar
 * @since     1.1.0
 */
class Parse extends Component
{
    // Public Methods
    // =========================================================================

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
        return new ICal($files, $config);
    }
}
