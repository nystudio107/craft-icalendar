[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nystudio107/craft-icalendar/badges/quality-score.png?b=v1)](https://scrutinizer-ci.com/g/nystudio107/craft-icalendar/?branch=v1) [![Code Coverage](https://scrutinizer-ci.com/g/nystudio107/craft-icalendar/badges/coverage.png?b=v1)](https://scrutinizer-ci.com/g/nystudio107/craft-icalendar/?branch=v1) [![Build Status](https://scrutinizer-ci.com/g/nystudio107/craft-icalendar/badges/build.png?b=v1)](https://scrutinizer-ci.com/g/nystudio107/craft-icalendar/build-status/v1) [![Code Intelligence Status](https://scrutinizer-ci.com/g/nystudio107/craft-icalendar/badges/code-intelligence.svg?b=v1)](https://scrutinizer-ci.com/code-intelligence)

# iCalendar plugin for Craft CMS 3.x

Tools for parsing & formatting the RFC 2445 iCalendar (.ics) specification

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require nystudio107/craft-icalendar

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for iCalendar.

Or you can just install the plugin via the Craft CMS Plugin Store in the Control Panel

## iCalendar Overview

iCalendar can read and parse RFC 2445 [iCalendar specification](https://icalendar.org/) `.ics` local & remote files, and allows you to query them for events.

iCalendar can also ensures that text conforms to the RFC 2445 [iCalendar specification](https://icalendar.org/) for `.ics` files. Specifically, it transforms text:
 
 * to ensure the line endings are `\r\n` as opposed to Twig's default `\n`
 * wrap long text to ensure that it is no more than 75 octets in length
 * removes unnecessary whitespace
 * strips all HTML tags from the text 

## Configuring iCalendar

There's nothing to configure.

## Using iCalendar

### Parsing RFC 2445 .ics Files

You can use iCalendar to parse an `.ics` file or collection of `.ics` files, and query them for events.

iCalendar uses the [ics-parse](https://github.com/u01jmg3/ics-parser) library under the hood, which works with both local files specific via path, and for remote files specified via URL.

Examples:
```twig
{# Pass in a path to a local file #}
{% set cal = parseIcs("/home/vagrant/sites/craft3/calendar.ics") %}

{# Pass in a URL to a remote file #}
{% set cal = parseIcs("https://example.com/calendar.ics") %}

{# Pass in an array of paths/URLs #}
{% set cal = parseIcs([
    "/home/vagrant/sites/craft3/calendar.ics",
    "https://example.com/calendar.ics",
]) %}
```

There is also a second parameter that allows you to pass in a [configuration](https://github.com/u01jmg3/ics-parser/blob/master/src/ICal/ICal.php#L248) array. Here's an example, with :
```twig
{% set cal = parseIcs("https://example.com/calendar.ics",[
    "defaultSpan": 2,
    "defaultTimeZone": "",
    "defaultWeekStart": "MO",
    "disableCharacterReplacement": false,
    "filterDaysAfter": null,
    "filterDaysBefore": null,
    "replaceWindowsTimeZoneIds": false,
    "skipRecurrence": false,
    "useTimeZoneWithRRules": false,
]) %}

```
The `parseIcs` function will return to you an [ICal](https://github.com/u01jmg3/ics-parser/blob/master/src/ICal/ICal.php) object that you can query in various ways.

The [ics-parser documentation](https://github.com/u01jmg3/ics-parser#methods) has a summary of the methods available, and the [code example](https://github.com/u01jmg3/ics-parser/blob/master/examples/index.php) shows a bit of it in use.

But here's a real-world example that parses a remote `.ics` file, and then loops through the events:

```twig
{% set cal = parseIcs(
    "https://trello.com/calendar/58818099de7afeb3eccf53c3/596c082de8b3646b91fe224c/a33556c5da5218fe3ed14f368b6b77bc.ics",
    {
        "defaultTimeZone": "America/New_York",
    }
) %}
{% set startDate = now | date | atom %}
{% set events = cal.eventsFromRange(startDate) %}
{% for event in events %}
    {{ dump(event) }}
{% endfor %}
```

This will output something like:
```php
    object(ICal\Event)[3111]
      public 'summary' => string '#39 @pika/web brings 2014 simplicity to 2019 JavaScript [To Do]' (length=63)
      public 'dtstart' => string '20190426T180000Z' (length=16)
      public 'dtend' => null
      public 'duration' => string 'PT1H' (length=4)
      public 'dtstamp' => string '20190425T163509Z' (length=16)
      public 'uid' => string '5c8039e1bbe53e8171c61bed@trello.com' (length=35)
      public 'created' => null
      public 'lastmodified' => null
      public 'description' => string 'We'll be talking to Fred K. Schott https://twitter.com/FredKSchott http://fredkschott.com/about/ about @pika/web that allows us to use modern web development without a massive build/bundle step!'
      public 'location' => null
      public 'sequence' => null
      public 'status' => null
      public 'transp' => null
      public 'organizer' => null
      public 'attendee' => null
```

Here's the [Event object](https://github.com/u01jmg3/ics-parser/blob/master/src/ICal/Event.php) so you can see the data structure.

### Formatting RFC 2445 text in Twig

To use iCalendar, just wrap your Twig code that outputs your iCalendar RFC 2445 text like so:

```twig
{% spaceless %}
{% header "Content-Type: text/calendar; charset=utf-8" %}
{% header "Content-Disposition: attachment; filename=cal.ics" %}
{% filter rfc2445 %}
BEGIN:VCALENDAR
PRODID:{{ entry.title }}
CALSCALE:GREGORIAN
VERSION:2.0
METHOD:PUBLISH
TRANSP:TRANSPARENT
X-WR-CALNAME:{{ entry.title }}
X-WR-TIMEZONE:America/New_York
BEGIN:VEVENT
    UID:1119
    DTSTAMP:{{ entry.startDate.getTimestamp() | date("Ymd", "UTC") }}T{{ entry.startDate.getTimestamp() | date("Gi", "UTC") }}00Z
    DTSTART:{{ entry.startDate.getTimestamp() | date("Ymd", "UTC") }}T{{ entry.startDate.getTimestamp() | date("Gi", "UTC") }}00Z
    DTEND:{{ entry.endDate.getTimestamp() | date("Ymd", "UTC") }}T{{ entry.endDate.getTimestamp() | date("Gi", "UTC") }}00Z
    LOCATION:On Campus Camden, SC
    SUMMARY:OPEN HOUSE (ON CAMPUS) FOR PROSPECTIVE FAMILIES/CADETS
    DESCRIPTION:This is a <strong>very long description</strong>, too long to fit inside of 75 octets, certainly! An on campus open house will be held on Saturday, December 1 2018 at 7pm.
    URL:{{ entry.url }}
    END:VEVENT
END:VCALENDAR
{% endfilter %}
{% endspaceless %}
```

This will output:
```
BEGIN:VCALENDAR
PRODID:Camden Open House
CALSCALE:GREGORIAN
VERSION:2.0
METHOD:PUBLISH
TRANSP:TRANSPARENT
X-WR-CALNAME:Camden Open House
X-WR-TIMEZONE:America/New_York
BEGIN:VEVENT
UID:1119
DTSTAMP:20181201T120101Z
DTSTART:20181201T120101Z
DTEND:20181108T120101Z
LOCATION:On Campus Camden, SC
SUMMARY:OPEN HOUSE (ON CAMPUS) FOR PROSPECTIVE FAMILIES/CADETS
DESCRIPTION:This is a very long description, too long to fit inside of 75 o
	ctets, certainly! An on campus open house will be held on Saturday, Decemb
	er 1 2018 at 7pm.
URL:test
END:VEVENT
END:VCALENDAR
```

Note that HTML code and whitespace have been stripped, and long lines have been wrapped. What you can't see is that the line endings are `\r\n` as per spec, as opposed to Twig's `\n` line ending.

You can put whatever Twig code you want inside of the filter to output your entries.

You can validate your `.ics` files using the [iCalendar validator](https://icalendar.org/validator.html)

## iCalendar Roadmap

Some things to do, and ideas for potential features:

* Release it

Brought to you by [nystudio107](https://nystudio107.com)
