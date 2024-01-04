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

namespace DarkSide\DsGprdCookie\Repository;

use DarkSide\DsGprdCookie\Entity\DsGprdCookie;
use DarkSide\DsGprdCookie\Entity\DsGprdCookieCategory;
use DarkSide\DsGprdCookie\Entity\DsGprdCookieInCategory;
use DarkSide\DsGprdCookie\Entity\DsGprdCookieLang;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;

class CookieRepository extends EntityRepository
{   
    /**
     * @param int $id_shop
     * @param int $id_lang
     * 
     * @return array
     */
    public function findAllActiveCookiesByShopId(int $id_shop, int $id_lang): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.cookie_service', 'c.cookie_name', 'c.enabled', 'c.script', 'c.extra_script', 'c.id')
            ->addSelect('cl.text_value')
            ->addSelect('cc.id as category_id')
            ->leftJoin(DsGprdCookieLang::class, 'cl', Join::WITH, 'c.id = cl.cookie')
            ->leftJoin(DsGprdCookieInCategory::class, 'cic', 'c.id = cic.cookie')
            ->leftJoin(DsGprdCookieCategory::class, 'cc', 'cic.category = cc.id')
            ->where('c.enabled = :enabled')
            ->andWhere('c.id_shop = :id_shop')
            ->andWhere('cl.id_lang = :id_lang')
            ->setParameter(':enabled', true)
            ->setParameter(':id_shop', $id_shop)
            ->setParameter(':id_lang', $id_lang)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}
