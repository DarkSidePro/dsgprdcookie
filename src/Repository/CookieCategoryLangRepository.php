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
        $categories = $this->createQueryBuilder('c')
            ->select('ccl.category', 'cc.readonly', 'cc.default_nabled', 'cc.type', 'ccl.text_value', 'ccl.category_name')
            ->from(DsGprdCookieCategoryLang::class, 'ccl')
            ->leftJoin(DsGprdCookieCategory::class, 'cc', Join::ON, 'ccl.category = cc.id')
            ->where('ccl.id_lang = :id_lang')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        return $categories;
    }
}
