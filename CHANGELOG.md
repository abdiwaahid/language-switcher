# Changelog

All notable changes to `language-switcher` will be documented in this file.

## v1.2.0 - 2026-10-15

### Added

- Laravel 13 support (requires PHP 8.3+).
- Test coverage for the facade, drivers, middleware, route, and Blade components.

### Fixed

- The `LanguageSwitcherMiddleware` is now reliably added to the `web` middleware group. On Laravel 11+ the framework's default groups could overwrite middleware pushed during boot.
- The switcher Blade component no longer relies on the global `LanguageSwitcher` facade alias, so it keeps working when aliases are disabled or not registered.
- Flag assets are only published when the corresponding image exists, avoiding issues with configured languages that have no flag.
- The `language-switcher` Artisan command now shows the current locale and the configured languages instead of a placeholder message.

## v1.1.0 - 2025-09-01

### Added

- Dark mode support for the dropdown component.
- RTL (Right-to-Left) layout support for the dropdown.

### Changed

- Asset publishing has been optimized. The `language-switcher-assets` tag now only publishes flag icons for the languages specifically listed in your configuration file, reducing unnecessary files.

## 1.1.0 - 2025-09-01

### Added

- Dark mode support for the dropdown component.
- RTL (Right-to-Left) layout support for the dropdown.

### Changed

- Asset publishing has been optimized. The `language-switcher-assets` tag now only publishes flag icons for the languages specifically listed in your configuration file, reducing unnecessary files.

## 1.0.0 - 2025-08-28

### Added

- Initial release of the package.
- Session and Cache drivers for storing locale.
- Facade for easy interaction.
- Middleware to automatically set the application locale.
- Blade component for frontend display.
- Added documentation for integration with FilamentPHP.
