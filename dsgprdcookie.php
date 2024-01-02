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

use DarkSide\DsGprdCookie\Database\Installer;
use DarkSide\DsGprdCookie\Exception\MissingServiceException;
use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
}

class Dsgprdcookie extends Module
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

        return parent::install()         
        && $this->registerHook('displayHeader')
        && $this->registerHook('displayBeforeBodyClosingTag')
        && $this->createTab();
    }

    private function createTab()
    {
        $container = SymfonyContainer::getInstance();
        $tabRepository = $container->get('prestashop.core.admin.tab.repository');

        $response = true;
        $parentTabID = $tabRepository->findOneIdByClassName('AdminDarkSideMenu');

        if ($parentTabID) {
            $parentTab = new Tab($parentTabID);
        } else {
            $parentTab = new Tab();
            $parentTab->active = 1;
            $parentTab->name = array();
            $parentTab->class_name = 'AdminDarkSideMenu';
            foreach (Language::getLanguages() as $lang) {
                $parentTab->name[$lang['id_lang']] = 'Dark-Side.pro';
            }
            $parentTab->id_parent = 0;
            $parentTab->module = '';
            $response &= $parentTab->add();
        }

        $parentTab_2ID = $tabRepository->findOneIdByClassName('AdminDarkSideMenuSecond');

        if ($parentTab_2ID) {
            $parentTab_2 = new Tab($parentTab_2ID);
        } else {
            $parentTab_2 = new Tab();
            $parentTab_2->active = 1;
            $parentTab_2->name = array();
            $parentTab_2->class_name = 'AdminDarkSideMenuSecond';
            foreach (Language::getLanguages() as $lang) {
                $parentTab_2->name[$lang['id_lang']] = 'Dark-Side Config';
            }
            $parentTab_2->id_parent = $parentTab->id;
            $parentTab_2->module = '';
            $response &= $parentTab_2->add();
        }

        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'CookieController';
        $tab->route_name = 'ds_gprdcookie_cookie_index';
        $tab->name = array();

        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = 'DS: GPRD Cookie';
        }

        $tab->id_parent = $parentTab_2->id;
        $tab->module = $this->name;
        $response &= $tab->add();

        return $response;
    }

    private function tabRem()
    {
        $container = SymfonyContainer::getInstance();
        $tabRepository = $container->get('prestashop.core.admin.tab.repository');

        $id_tab = $tabRepository->findOneByClassName('CookieBa');
        if ($id_tab) {
            $tab = new Tab($id_tab);
            $tab->delete();
        }

        $parentTab_2ID = $tabRepository->findOneByClassName('AdminDarkSideMenuSecond');

        if ($parentTab_2ID) {
            $tabCount_2 = Tab::getNbTabs($parentTab_2ID);
            if ($tabCount_2 == 0) {
                $parentTab_2 = new Tab($parentTab_2ID);
                $parentTab_2->delete();
            }
        }

        $parentTabID = $tabRepository->findOneByClassName('AdminDarkSideMenu');

        if ($parentTabID) {
            $tabCount = Tab::getNbTabs($parentTabID);
            if ($tabCount == 0) {
                $parentTab = new Tab($parentTabID);
                $parentTab->delete();
            }
        }

        return true;
    }

    public function uninstall()
    {
        return parent::uninstall() && $this->tabRem();
    }

    public function getContent()
    {
        $router = SymfonyContainer::getInstance()->get('router');

        return Tools::redirectAdmin($router->generate('ds_gprdcookie_cookie_index'));
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

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/build.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookDisplayBeforeBodyClosingTag()
    {
        $shop_id = Context::getContext()->shop->id;
        $container = SymfonyContainer::getInstance();

        $cookieRepository = $container->get('darkside.module.dsgprd.repository.cookie_repository');
        $cookies = $cookieRepository->findAllActiveCookiesByShopId($shop_id);

        $this->smarty->assign('cookies', $cookies);

        return $this->fetch('module:' . '/' . $this->name . '/views/templates/hook/hookDisplayBeforeBodyClosingTag.tpl');
    }
}
