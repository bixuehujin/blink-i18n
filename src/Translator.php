<?php

namespace blink\i18n;

use blink\core\Configurable;
use blink\core\ObjectTrait;
use blink\core\InvalidParamException;
use Symfony\Component\Translation\Translator as BaseTranslator;


/**
 * Class Translator
 *
 * @package blink\i18n
 */
class Translator extends BaseTranslator implements Configurable
{
    use ObjectTrait;

    public $debug = false;
    public $cacheDir;
    public $defaultLocale = 'en-US';
    public $loaders = [];
    public $resources = [];

    public function __construct($config = [])
    {
        foreach ($config as $name => $value) {
            $this->$name = $value;
        }

        parent::__construct($this->defaultLocale, null, $this->cacheDir, $this->debug);

        $this->init();
    }

    public function init()
    {
        foreach ($this->loaders as $format => $loader) {
            $loader = make($loader);
            $this->addLoader($format, $loader);
        }

        foreach ($this->resources as $resource) {
            if (!isset($resource['format'], $resource['resource'], $resource['locale'])) {
                throw new InvalidParamException('The resource item requires format, resource and locale keys.');
            }
            $this->addResource($resource['format'], $resource['resource'], $resource['locale'], isset($resource['domain']) ? $resource['domain'] : null);
        }
    }
}
