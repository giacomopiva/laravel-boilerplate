<?php

/**
 * This PHP code was authored by Alessandro Tieri.
 * Please contact Alessandro Tieri for any inquiries related to this code.
 *
 * @author Alessandro Tieri
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Determine and return the appropriate route based on the user's role.
 *
 * @return string The name of the route to redirect to.
 */
function homeRoute()
{
    if (! Auth::check()) {
        return route('login');
    }

    $role = Auth::user()->getRoleName();

    if ($role === 'Amministratore') {
        return route('admin.home');
    }
    if ($role === 'Utente') {
        return route('user.home');
    }

    return route('admin.home');
}

/**
 * Determine if a section is active based on a list of section names.
 *
 * @param  array<string, string>  $list  An array of section names to check for activity.
 * @param  int  $segment  (Optional) An optional segment used to generate the section name.
 * @return bool Returns true if any section in the list is active, false otherwise.
 */
function isSectionActive(array $list, $segment = 0): bool
{
    foreach ($list as $l) {
        if (Str::contains(appSectionName($segment), $l)) {
            return true;
        }
    }

    return false;
}

/**
 * Generate a user-readable application section name.
 *
 * @param  int  $segment  (Optional) An optional segment used to generate the section name.
 * @return string The user-readable section name.
 */
function userReadableAppSectionName($segment = 0): string
{
    $sectionName = appSectionName($segment);

    return $sectionName !== null ? Str::ucfirst(__('boilerplate.'.$sectionName)) : '';
}

/**
 * Get the name of a specific segment from the request's URL segments.
 *
 * @param  int  $segment  (Optional) The segment number to retrieve (default is 0).
 * @return string|null The name of the specified segment or the previous segment if not found.
 */
function appSectionName($segment = 0): ?string
{
    return request()->segments()[$segment] ?? request()->segments()[$segment - 1];
}

/**
 * Return the validated admin theme (Tabler) settings, ready to be used as
 * data-bs-* attributes. Any .env value not present in the allowed option
 * list (config('admin-theme.options')) falls back to the Tabler default.
 *
 * @return array<string, string> Keys: mode, primary, base, radius, font.
 */
function adminThemeSettings(): array
{
    $options = config('admin-theme.options');
    $defaults = config('admin-theme.defaults');

    $settings = [];
    foreach ($defaults as $key => $default) {
        $value = config("admin-theme.{$key}");
        $settings[$key] = in_array($value, $options[$key] ?? [], true) ? $value : $default;
    }

    return $settings;
}

/**
 * Build the Bunny Fonts (https://fonts.bunny.net) stylesheet URL for the
 * font family configured via ADMIN_FONT_FAMILY/ADMIN_FONT_WEIGHTS. Bunny
 * exposes a Google-Fonts-compatible CSS endpoint keyed by a lowercase
 * hyphenated slug of the family name (e.g. "Plus Jakarta Sans" -> "plus-jakarta-sans").
 *
 * @return string The full <link> href for the font stylesheet.
 */
function adminBunnyFontCssUrl(): string
{
    $slug = Str::slug(config('admin-theme.font_family', 'Inter'));
    $weights = config('admin-theme.font_weights', '400,500,600,700');

    return "https://fonts.bunny.net/css?family={$slug}:{$weights}";
}
