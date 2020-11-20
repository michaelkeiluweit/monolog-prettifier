<?php declare(strict_types=1);

namespace MichaelKeiluweit\MonologPrettifier\Controller;


use MichaelKeiluweit\MonologPrettifier\Model\Log\Collection;
use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Framework\Logger\Validator\PsrLoggerConfigurationValidator;
use Psr\Log\LogLevel;

class MonologPrettifier extends FrontendController
{
    protected $_blLoadComponents = false;

    /**
     * @see PsrLoggerConfigurationValidator
     * @var string[]
     */
    private array $colors = [
        LogLevel::DEBUG     => '28a745',
        LogLevel::INFO      => '6c757d',
        LogLevel::NOTICE    => '007bff',
        LogLevel::WARNING   => 'ffc107',
        LogLevel::ERROR     => 'dc3545',
        LogLevel::CRITICAL  => 'dc3545',
        LogLevel::ALERT     => 'dc3545',
        LogLevel::EMERGENCY => 'dc3545',
    ];

    public function render(): string
    {
        if (!$this->hasAdminRights()) {
            Registry::getUtils()->redirect('');
        }

        $collection = new Collection();
        $this->_aViewData['entities'] = $collection->getEntities();
        $this->_aViewData['amount'] = count($collection->getEntities());

        return 'list.tpl';
    }

    protected function hasAdminRights(): bool
    {
        if ($this->getUser() === false) {
            return false;
        }

        return
            $this->getUser()->isMallAdmin() ||
            (int) $this->getUser()->oxuser__oxrights->value === Registry::getConfig()->getShopId()
        ;
    }

    public function getColorByLogLevelName(string $logLevel): string
    {
        $logLevel = strtolower($logLevel);

        if (!isset($logLevel, $this->colors)) {
            $message = sprintf('Log level "%s" is not known!', $logLevel);
            getLogger()->warning($message);
            return '';
        }

        return $this->colors[$logLevel];
    }
}