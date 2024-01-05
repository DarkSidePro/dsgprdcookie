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

namespace DarkSide\DsGprdCookie\Form;

use Context;
use DarkSide\DsGprdCookie\Entity\DsGprdCookie;
use DarkSide\DsGprdCookie\Entity\DsGprdCookieInCategory;
use DarkSide\DsGprdCookie\Entity\DsGprdCookieLang;
use Doctrine\ORM\EntityManagerInterface;
use DarkSide\DsGprdCookie\Repository\CookieRepository;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler\FormDataHandlerInterface;

class CookieFieldFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CookieRepository
     */
    private $cookieRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param CookieRepository $quoteRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        CookieRepository $cookieRepository,
        EntityManagerInterface $entityManager,
    ) {
        $this->cookieRepository = $cookieRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $id_shop = (int) Context::getContext()->shop->id;

        if ($id_shop === null) {
            return false;
        }

        $cookie = new DsGprdCookie;
        $cookie->setIdShop($data['id_shop']);
        $cookie->setEnabled($data['enabled']);
        $cookie->setCookieName($data['cookie_name']);
        $cookie->setCookieService($data['cookie_service']);

        $this->entityManager->persist($cookie);
        
        $cookieInCategory = new DsGprdCookieInCategory;
        $cookieInCategory->setCookie($cookie);
        $cookieInCategory->setCategory($data['cookie_category']);

        $this->entityManager->persist($cookieInCategory);

        foreach ($data['text_value'] as $langId => $langContent) {
            $cookieLang = new DsGprdCookieLang();
            $cookieLang
                ->setIdLang($langId)
                ->setTextValue($langContent)                
            ;

            $cookieLang->setCookie($cookie);

            $this->entityManager->persist($cookieLang);

        }
        
        $this->entityManager->flush();

        return $cookie->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $cookie = $this->cookieRepository->findOneById($id);
        $cookie->setEnabled($data['enabled']);
        $cookie->setCookieName($data['cookie_name']);
        $cookie->setCookieService($data['cookie_service']);

        $cics = $cookie->getCookieInCategories();

        foreach ($cics as $cic) {
            $cic->setCategory($data['cookie_category']);
        }
        
        foreach ($data['text_value'] as $langId => $content) {
            $cookieLang = $cookie->getCookieLangByLangId($langId);
            if (null === $cookieLang) {
                continue;
            }
            $cookieLang
                ->setTextValue($content['text_value'])                
            ;
        }
        $this->entityManager->flush();

        return $cookie->getId();
    }

    /**
     * @param DsGprdCookie $dsGPRDCookie
     */
    public function delete(DsGprdCookie $dsGPRDCookie)
    {
        $langs = $dsGPRDCookie->getLangs();

        foreach ($langs as $lang) {
            $this->entityManager->remove($lang);
        }

        $this->entityManager->remove($dsGPRDCookie);
        $this->entityManager->flush();

        return true;
    }
}
