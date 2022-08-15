# iCalendar Changelog

## 4.0.1 - 2022.09.15
### Changed
* Fixed an issue with multi-byte encoded content that would cause PHP to run out of memory ([#34](https://github.com/nystudio107/craft-icalendar/issues/34))

## 4.0.0 - 2022.06.29
### Added
* Initial Craft CMS 4 release

### Changed
* Bump `johngrogg/ics-parser` to `^3.0.0` ([#32](https://github.com/nystudio107/craft-icalendar/issues/32))

## 4.0.0-beta.1 - 2022.03.27

### Added

* Initial Craft CMS 4 compatibility

## 1.1.2 - 2021.10.10
### Fixed
* Fixed an issue where paragraphs coming from a rich text field would be broken into multiple lines, and then not read by iCal ([#26](https://github.com/nystudio107/craft-icalendar/issues/26))
* Fixed incorrect date format in the example Twig code in the documentation

## 1.1.1 - 2021.09.08
### Fixed
* Decode any HTML entities in the rfc2545 filter ([#1](https://github.com/nystudio107/craft-icalendar/issues/1))
* Add `\r\n\t` to long lines that are split ([#1](https://github.com/nystudio107/craft-icalendar/issues/1))

## 1.1.0 - 2018.04.25
### Added
* Added `parseIcs` function to allow the parsing of `.ics` files
* Added plugin icon

### Changed
* Updated Twig namespacing to be compliant with deprecated class aliases in 2.7.x

## 1.0.1 - 2018-12-16
### Added
* Added icon
* Fixed `implode()`

## 1.0.0 - 2018-11-15
### Added
* Initial release
