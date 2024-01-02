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

use DarkSide\DsGprdCookie\Entity\DsGprdCookieField;
use DarkSide\DsGprdCookie\Entity\DsGprdCookieFieldLang;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class CookieFieldLangRepository extends EntityRepository
{
    /**
     * @param int $lang_id
     * @see array_reduce() 
     * 
     * @return array
     */
    public function findFieldLangByIdLang(int $lang_id): array
    {
        $fields = $this->createQueryBuilder('f')
            ->select('cfl.field_name', 'cfl.text_value')
            ->from(DsGprdCookieFieldLang::class, 'cfl')
            ->leftJoin(DsGprdCookieField::class, 'cf', Join::WITH, 'cfl.field = cf.id')
            ->andWhere('cfl.id_lang = :id_lang')
            ->setParameter(':id_lang', $lang_id)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        $transformedArray = array_reduce($fields, function ($result, $element) {
            $fieldName = $element['field_name'];
        
            // Dodaj nowy element do wynikowej tablicy
            $result[$fieldName] = $element;
        
            return $result;
        }, []);
        
        return $transformedArray;
    }
}
