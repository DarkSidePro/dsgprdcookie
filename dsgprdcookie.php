<?php
/**
 * 2007-2020 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0).
 * It is also available through the world-wide-web at this URL: https://opensource.org/licenses/AFL-3.0
 */
declare(strict_types=1);

use DarkSide\DsOmnibus\Database\Installer;
use DarkSide\DsOmnibus\Exception\MissingServiceException;
use Doctrine\DBAL\Connection;
use Symfony\Component\Ldap\Adapter\ConnectionInterface;

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
}

class DsGPRDCookie extends Module
{
    public function __construct()
    {
        $this->name = 'dsgprdcookie';
        $this->author = 'Dark-Side.pro';
        $this->version = '1.0.0';
        $this->ps_versions_compliancy = ['min' => '1.7.7', 'max' => '8.99.99'];

        parent::__construct();

        $this->displayName = $this->l('DS: GPRD Cookie');
        $this->description = $this->l('Help your customer to protect them privacy with GPRD');
    }

    public function install()
    {
        $this->installTables();

        return parent::install() && $this->registerHook('actionProductSave') && $this->registerHook('displayOmnibus');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getContent()
    {
        Tools::redirectAdmin(
            $this->context->link->getAdminLink('AdminDemodoctrineQuote')
        );
    }

    /**
     * @return bool
     */
    private function installTables()
    {
        $installer = $this->getInstaller();
        $errors = $installer->createTables();
    }

    /**
     * @throws MissingServiceException
     *      
     */
    private function getInstaller()
    {
        $translator = $this->getTranslator();
        $installer = new Installer($translator);
        
        return $installer;
    }
}
