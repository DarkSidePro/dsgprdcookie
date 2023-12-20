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

namespace DarkSide\DsGPRDCookie\Form;

use Context;
use DarkSide\DsGPRDCookie\Repository\CookieRepository;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider\FormDataProviderInterface;

class CookieFieldFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var CookieRepository
     */
    private $repository;

    /**
     * @param CookieRepository $repository
     */
    public function __construct(CookieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     */
    public function getData($id)
    {
        $cookie = $this->repository->findOneById($id);

        $cookieData = [
            'id_shop' => $cookie->getIdShop(),
            'cookie_service' => $cookie->getCookieService(),
            'cookie_category' => $cookie->getCookieCategory(),
            'cookie_name' => $cookie->getCookieName(),
            'enabled' => $cookie->isEnabled()
        ];

        foreach ($cookie->getLangs() as $cookieLang) {
            $cookieData['text_value'][$cookieLang->getLang()] = $cookieLang->getTextValue();
        }

        return $cookieData;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData()
    {
        return [
            'id_shop' => Context::getContext()->shop->id,
            'cookie_service' => '',
            'cookie_category' => null,
            'cookie_name' => '',
            'enabled' => false,
            'text_value' => [],
        ];
    }
}
