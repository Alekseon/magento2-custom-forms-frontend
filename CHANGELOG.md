# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Changed
### Fixed
### Added
### Removed

## [100.1.4] - 2024-11-17
### Added
- changes for postal code validator

## [100.1.3] - 2024-06-06
### Fixed
- Fix validation-mixin (https://github.com/Alekseon/magento2-custom-forms-frontend/pull/1)

## [100.1.2] - 2023-12-03
### Added
- Image file frontend validation

## [100.1.1] - 2023-10-06
### Changed
- getLabelAllowedTags method, to allow a tags - to allow tag <a href> in labels, for case with link to 'agreements'

## [100.1.0] - 2023-06-21
### Changed
- frontend inputs moved from Alekseon_WidgetForms to Alekseon_CustonFormsFrontend
- form label moved to separated template
### Added
- container classes for div elements 

## [100.0.7] - 2023-05-15
### Fixed
- fix for invalid argument type error (https://github.com/Alekseon/magento2-widget-forms/issues/18)

## [100.0.6] - 2023-05-06
### Fixed
- fixed error: explode(): Passing null to parameter

## [100.0.5] - 2023-05-06
### Added
- code quality improvements
- github action
- introduced strict_types

## [100.0.4] - 2023-04-23
### Fixed
- fix for Exception: Warning: Undefined array key "height"
- plugin for alekseon/custom-forms-email-notification in version 100.2.0 and above
- moved frontendBlocks to global area to be used in emails
- frontendblock for rating field

## [100.0.3] - 2022-11-19
### Added
- template for image field
### Added
- warning log when field is missing in form but used in template

## [100.0.2] - 2022-10-27
### Fixed
- fix for magento 2.4

## [100.0.1] - 2022-10-22
### Added
- aroundGetSuccessTitle plugin 
### Removed
- removed aroundGetFailureMessage plugin

## [100.0.0] - 2022-10-22
### Added
- init
