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
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class CookieRepository extends EntityRepository
{
    public function findAllActiveCookiesByShopId(int $id_shop)
    {
        return $this->createQueryBuilder('c')
            ->from(DsGprdCookie::class, 'c')
            ->where('c.enabled = :enabled')
            ->andWhere('c.id_shop = :id_shop')
            ->setParameter(':enbaled', true)
            ->setParameter(':id_shop', $id_shop)
            ->getQuery()
            ->getResult();
    }
}
