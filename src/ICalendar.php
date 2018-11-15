<?php
/**
 * iCalendar plugin for Craft CMS 3.x
 *
 * Ensures that text conforms to the RFC 2445 iCalendar specification
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2018 nystudio107
 */

namespace nystudio107\icalendar;

use nystudio107\icalendar\services\Convert as ConvertService;
use nystudio107\icalendar\twigextensions\ICalendarTwigExtension;

use Craft;
use craft\base\Plugin;

/**
 * Class ICalendar
 *
 * @author    nystudio107
 * @package   ICalendar
 * @since     1.0.0
 *
 * @property  ConvertService $convert
 */
class ICalendar extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ICalendar
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->registerTwigExtension(new ICalendarTwigExtension());

        Craft::info(
            Craft::t(
                'icalendar',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================
}
