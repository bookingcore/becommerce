<?php


namespace Modules\Email\Plugins;


use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class CssInlinerPlugin implements \Swift_Events_SendListener
{
    /**
     * @var CssToInlineStyles
     */
    protected $converter;

    /**
     * @var string[]
     */
    protected $cssCache;

    public function __construct()
    {
        $this->converter = new CssToInlineStyles();
    }

    /**
     * @param \Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(\Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();

        $css = $this->concatCss();

        if ($message->getContentType() === 'text/html'
            || ($message->getContentType() === 'multipart/alternative' && $message->getBody())
            || ($message->getContentType() === 'multipart/mixed' && $message->getBody())
        ) {
            $body = $message->getBody();
            $message->setBody($this->converter->convert($body, $css));
        }

        foreach ($message->getChildren() as $part) {
            if (strpos($part->getContentType(), 'text/html') === 0) {
                $body = $part->getBody();
                $part->setBody($this->converter->convert($body, $css));
            }
        }
    }

    /**
     * Do nothing
     *
     * @param \Swift_Events_SendEvent $evt
     */
    public function sendPerformed(\Swift_Events_SendEvent $evt)
    {
        // Do Nothing
    }

    protected function concatCss(): string
    {
        $output = '';
        foreach (config('bc.email.css_files') as $cssResource) {
            $output.= $this->fetchCss($cssResource);
        }

        return $output;
    }

    protected function fetchCss(string $filename): string
    {
        if (isset($this->cssCache[$filename])) {
            return $this->cssCache[$filename];
        }

        $content = file_get_contents(public_path($filename));
        if (! $content) {
            return '';
        }

        $this->cssCache[$filename] = $content;

        return $content;
    }

}
