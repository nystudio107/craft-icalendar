# iCalendar plugin for Craft CMS 3.x

Ensures that text conforms to the RFC 2445 iCalendar specification

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require nystudio107/craft-icalendar

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for iCalendar.

Or you can just install the plugin via the Craft CMS Plugin Store in the AdminCP

## iCalendar Overview

iCalendar ensures that text conforms to the RFC 2445 [iCalendar specification](https://icalendar.org/) for `.ics` files. Specifically, it transforms text:
 
 * to ensure the line endings are `\r\n` as opposed to Twig's default `\n`
 * wrap long text to ensure that it is no more than 75 octets in length
 * removes unnecessary whitespace
 * strips all HTML tags from the text 

## Configuring iCalendar

There's nothing to configure.

## Using iCalendar

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
