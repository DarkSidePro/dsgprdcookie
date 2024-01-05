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

use DarkSide\DsGprdCookie\Entity\DsGprdCookieCategory;
use DarkSide\DsGprdCookie\Entity\DsGprdCookieCategoryLang;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class CookieCategoryLangRepository extends EntityRepository
{
    /**
     * @param int $id_lang
     * 
     * @return array
     */
    public function findCategoriesByLangId(int $id_lang): array
    {
        $categories = $this->createQueryBuilder('ccl')
            ->select('cc.id')
            ->addSelect('cc.readonly')
            ->addSelect('cc.default_enabled')
            ->addSelect('cc.type')
            ->addSelect('ccl.text_value')
            ->addSelect('ccl.category_name')
            ->leftJoin(DsGprdCookieCategory::class, 'cc', Join::WITH, 'ccl.category = cc.id')
            ->where('ccl.id_lang = :id_lang')
            ->setParameter(':id_lang', $id_lang)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        return $categories;
    }
}
