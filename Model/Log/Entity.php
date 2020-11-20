<?php declare(strict_types=1);

namespace MichaelKeiluweit\MonologPrettifier\Model\Log;


class Entity
{
    private $date;

    private $logger;

    private $level;

    private $message;

    private $context;

    /**
     * OxideshopLogEntity constructor.
     * @param string[] $matches
     */
    public function __construct(array $matches)
    {
        $this->date = $matches['date'];
        $this->logger = $matches['logger'];
        $this->level = $matches['level'];
        $this->message = $matches['message'];
        $this->context = $matches['context'];
    }

    /**
     * @return string
     */
    public function getDate() : string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getLogger() : string
    {
        return $this->logger;
    }

    /**
     * @return string
     */
    public function getLevel() : string
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getContext() : string
    {
        return $this->context;
    }

    /**
     * @return string
     */
    public function getContextFormatted() : string
    {
        $context = explode('\n', $this->context);
        $context = array_map(
            function ($entry) {
                return sprintf('<p>%s</p>', $entry);
            },
            $context
        );
        $context = implode('',$context);

        $context = str_replace(['["', '"]'],  '', $context);
        $context = str_replace('\\\\', '\\', $context);
        $context = preg_replace('(\d\):)', '$0<br>', $context);

        return $context;
        //return nl2br($this->context);
    }

    /**
     * Transforms
     *
     * #0 /var/www/html/vendor/oxid-esales/oxideshop-ce/source/Application/Controller/FrontendController.php(574):
     * OxidEsales\\EshopEnterprise\\Application\\Controller\\ArticleDetailsController->generateViewId()
     * #1 /var/www/html/vendor/oxid-esales/oxideshop-ce/source/Core/SeoEncoder.php(402):
     * OxidEsales\\EshopCommunity\\Application\\Controller\\FrontendController->getViewId()
     *
     * into
     *
     * #0 /var/www/html/vendor/oxid-esales/oxideshop-ce/source/Application/Controller/FrontendController.php(574):
     * OxidEsales\\EshopEnterprise\\Application\\Controller\\ArticleDetailsController->generateViewId()
     *
     * #1 /var/www/html/vendor/oxid-esales/oxideshop-ce/source/Core/SeoEncoder.php(402):
     * OxidEsales\\EshopCommunity\\Application\\Controller\\FrontendController->getViewId()
     *
     * @return string[]
     */
    public function getContextAsArray() : array
    {
        $context = explode('\n', $this->context);
        // reattach the lost control char \n
        $context = array_map(function ($entry) {
            return $entry .= "\n";
        }, $context);

        return $context;
    }
}