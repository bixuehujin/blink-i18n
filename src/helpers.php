<?php

/**
 * Returns the i18n component.
 *
 * @return \blink\i18n\Translator
 */
function i18n()
{
    return app('i18n');
}

/**
 * Translates the given message.
 *
 * @param $id
 * @param array $parameters
 * @param null $domain
 * @param null $locale
 * @return string The translated string
 */
function translate($id, $parameters = [], $domain = null, $locale = null)
{
    return i18n()->trans($id, $parameters, $domain, $locale);
}
