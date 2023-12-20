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
use DarkSide\DsGPRDCookie\Entity\DsGPRDCookie;
use DarkSide\DsGPRDCookie\Entity\DsGPRDCookieLang;
use Doctrine\ORM\EntityManagerInterface;
use DarkSide\DsGPRDCookie\Repository\CookieRepository;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler\FormDataHandlerInterface;

class CookieFormDataHandler implements FormDataHandlerInterface
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

        $cookie = new DsGPRDCookie;
        $cookie->setIdShop($data['id_shop']);
        $cookie->setEnabled($data['enabled']);
        $cookie->setCookieName($data['cookie_name']);
        $cookie->setCookieService($data['cookie_service']);

        foreach ($data['text_value'] as $langId => $langContent) {
            $cookieLang = new DsGPRDCookieLang();
            $cookieLang
                ->setIdLang($langId)
                ->setTextValue($langContent)                
            ;

            $cookie->addLang($cookieLang);
        }
        $this->entityManager->persist($cookie);
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
     * @param DsGPRDCookie $dsGPRDCookie
     */
    public function delete(DsGPRDCookie $dsGPRDCookie)
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