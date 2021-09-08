# iCalendar Changelog

## 1.1.2 - UNRELEASED
### Fixed
* Fixed an issue where descriptions are cut off at paragraph breaks in iCal ([#26](https://github.com/nystudio107/craft-icalendar/issues/26))

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
