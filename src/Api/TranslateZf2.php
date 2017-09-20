<?php

namespace Reliv\RcmGoogleAnalytics\Api;

use Zend\I18n\Translator\TranslatorInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class TranslateZf2 implements Translate
{
    const OPTIONS_TEXT_DOMAIN = 'textDomain';
    const OPTIONS_LOCALE = 'locale';
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(
        TranslatorInterface $translator
    ) {
        $this->translator = $translator;
    }

    /**
     * @param string $message
     * @param array  $options
     *
     * @return mixed
     */
    public function __invoke(
        string $message,
        array $options = []
    ):string
    {
        return $this->translator->translate(
            $message,
            $this->getOption(self::OPTIONS_TEXT_DOMAIN, 'default'),
            $this->getOption(self::OPTIONS_LOCALE, null)
        );
    }

    /**
     * @param array  $options
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    protected function getOption(array $options, $key, $default = null)
    {
        if (array_key_exists($key, $options)) {
            return $options[$key];
        }

        return $default;
    }
}
