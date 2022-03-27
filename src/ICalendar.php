<?php
/**
 * iCalendar plugin for Craft CMS 3.x
 *
 * Tools for parsing & formatting the RFC 2445 iCalendar (.ics) specification
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2018 nystudio107
 */

namespace nystudio107\icalendar;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use nystudio107\icalendar\services\Convert as ConvertService;
use nystudio107\icalendar\services\Parse as ParseService;
use nystudio107\icalendar\twigextensions\ICalendarTwigExtension;
use nystudio107\icalendar\variables\ICalendarVariable;
use yii\base\Event;

/**
 * Class ICalendar
 *
 * @author    nystudio107
 * @package   ICalendar
 * @since     1.0.0
 *
 * @property  ConvertService $convert
 * @property  ParseService $parse
 */
class ICalendar extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ?ICalendar
     */
    public static ?ICalendar $plugin = null;

    /**
     * @var ?ICalendarVariable
     */
    public static ?ICalendarVariable $variable = null;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public bool $hasCpSection = false;

    /**
     * @var bool
     */
    public bool $hasCpSettings = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        $config['components'] = [
            'convert' => ConvertService::class,
            'parse' => ParseService::class,
        ];

        parent::__construct($id, $parent, $config);
    }

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;
        self::$variable = new ICalendarVariable();
        // Register Twig extension
        Craft::$app->view->registerTwigExtension(new ICalendarTwigExtension());
        // Register variable
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            static function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('icalendar', self::$variable);
            }
        );

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
