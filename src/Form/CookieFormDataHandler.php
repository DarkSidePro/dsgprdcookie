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
use DarkSide\DsGprdCookie\Repository\CookieCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use DarkSide\DsGprdCookie\Repository\CookieRepository;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler\FormDataHandlerInterface;

class CookieFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CookieRepository
     */
    private CookieRepository $cookieRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var CookieCategoryRepository
     */
    private CookieCategoryRepository $categoryRepository;

    /**
     * @param CookieRepository $quoteRepository
     * @param CookieCategoryRepository $categoryRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        CookieRepository $cookieRepository,
        CookieCategoryRepository $categoryRepository,
        EntityManagerInterface $entityManager,
    ) {
        $this->cookieRepository = $cookieRepository;
        $this->categoryRepository = $categoryRepository;
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
        $cookie->setScript($data['script']);
        $cookie->setExtraScript($data['extra_script']);
        $cookie->setPosition($data['position']);

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
        $cookie->setScript($data['script']);
        $cookie->setExtraScript($data['extra_script']);
        $cookie->setPosition($data['position']);

        $cookieLangs = $cookie->getLangs();

        $existingLangIds = $cookieLangs->map(function ($cookieLang) {
            return $cookieLang->getIdLang();
        });
        
        foreach ($data['text_value'] as $langId => $langContent) {
            if (!$existingLangIds->contains($langId)) {
                // Dodajemy nowy rekord
                $newCookieLang = new DsGprdCookieLang();
                $newCookieLang
                    ->setIdLang($langId)
                    ->setTextValue($langContent);
        
                $cookieLangs->add($newCookieLang);
                $this->entityManager->persist($newCookieLang);
            } else {
                // Aktualizujemy istniejący rekord
                $cookieLang = $cookieLangs->filter(function ($cookieLang) use ($langId) {
                    return $cookieLang->getIdLang() === $langId;
                })->first();
        
                if ($cookieLang instanceof DsGprdCookieLang) {
                    $cookieLang->setTextValue($langContent);
                }
            }
        }
        

        $cookieInCategories = $cookie->getCookieInCategories();

        foreach ($cookieInCategories as $cic) {
            $cic->setCategory($data['cookie_category']);
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

        $cookieInCategories = $dsGPRDCookie->getCookieInCategories();

        foreach ($cookieInCategories as $item) {
            $this->entityManager->remove($item);
        }


        $this->entityManager->remove($dsGPRDCookie);
        $this->entityManager->flush();

        return true;
    }
}
