<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

declare(strict_types=1);

namespace DarkSide\DsGprdCookie\Grid\Definition\Factory;

use PrestaShop\PrestaShop\Core\Grid\Action\Bulk\BulkActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Bulk\Type\SubmitBulkAction;
use PrestaShop\PrestaShop\Core\Grid\Action\GridActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\LinkRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\SubmitRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Type\SimpleGridAction;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollection;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\BulkActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ChoiceColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\DataColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\StatusColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\AbstractGridDefinitionFactory;
use PrestaShop\PrestaShop\Core\Grid\Filter\Filter;
use PrestaShop\PrestaShop\Core\Grid\Filter\FilterCollection;
use PrestaShopBundle\Form\Admin\Type\SearchAndResetType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CookieGridDefinitionFactory extends AbstractGridDefinitionFactory
{
    const GRID_ID = 'ds_cookie_cookie';

    /**
     * {@inheritdoc}
     */
    protected function getId()
    {
        return self::GRID_ID;
    }

    /**
     * {@inheritdoc}
     */
    protected function getName()
    {
        return $this->trans('Cookies', [], 'Modules.DsGprdCookie.Admin');
    }

    /**
     * {@inheritdoc}
     */
    protected function getColumns()
    {
        return (new ColumnCollection())
            ->add(
                (new BulkActionColumn('bulk'))
                    ->setOptions([
                        'bulk_field' => 'id',
                    ])
            )
            ->add(
                (new DataColumn('id'))
                    ->setOptions([
                        'field' => 'id',
                    ])
            )
            ->add(
                (new DataColumn('cookie_service'))
                    ->setName($this->trans('Service name', [], 'Modules.DsGprdCookie.Admin'))
                    ->setOptions([
                        'field' => 'cookie_service',
                    ])
            )
            ->add(
                (new DataColumn('category_name'))
                    ->setName($this->trans('Category', [], 'Modules.DsGprdCookie.Admin'))
                    ->setOptions([
                        'field' => 'category_name',
                    ])
            )
            ->add(
                (new DataColumn('cookie_name'))
                    ->setName($this->trans('Cookie part name', [], 'Modules.DsGprdCookie.Admin'))
                    ->setOptions([
                        'field' => 'cookie_name',
                    ])
            )
            ->add(
                (new StatusColumn('enabled'))
                    ->setName($this->trans('Active', [], 'Modules.DsGprdCookie.Admin'))
                    ->setOptions([
                        'field' => 'enabled',
                    ])
            )
            ->add(
                (new ActionColumn('actions'))
                    ->setName($this->trans('Actions', [], 'Admin.Actions'))
                    ->setOptions([
                        'actions' => (new RowActionCollection())
                            ->add(
                                (new LinkRowAction('edit'))
                                    ->setIcon('edit')
                                    ->setOptions([
                                        'route' => 'ds_gprdcookie_cookie_edit',
                                        'route_param_name' => 'id',
                                        'route_param_field' => 'id'
                                    ])
                            )
                            ->add(
                                (new LinkRowAction('delete'))
                                    ->setName($this->trans('Delete', [], 'Admin.Actions'))
                                    ->setIcon('delete')
                                    ->setOptions([
                                        'route' => 'ds_gprdcookie_cookie_delete',
                                        'route_param_name' => 'id',
                                        'route_param_field' => 'id',
                                        'confirm_message' => $this->trans(
                                            'Delete selected item?',
                                            [],
                                            'Admin.Notifications.Warning'
                                        ),
                                    ])
                            )
                    ])
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function getFilters()
    {
        
        return (new FilterCollection())
            ->add(
                (new Filter('id', TextType::class))
                    ->setTypeOptions([
                        'required' => false,
                        'attr' => [
                            'placeholder' => $this->trans('ID', [], 'Modules.DsGprdCookie.Admin'),
                        ],
                    ])
                    ->setAssociatedColumn('id')
            )
            ->add(
                (new Filter('cookie_service', TextType::class))
                    ->setTypeOptions([
                        'required' => false,
                        'attr' => [
                            'placeholder' => $this->trans('Service name', [], 'Modules.DsGprdCookie.Admin'),
                        ],
                    ])
                    ->setAssociatedColumn('cookie_service')
            )
            ->add(
                (new Filter('category_name', ChoiceType::class, [
                    'choices' => []
                ]))
                    ->setTypeOptions([
                        'required' => false,
                        'attr' => [
                            'placeholder' => $this->trans('Cookie category', [], 'Modules.DsGprdCookie.Admin'),
                        ],
                    ])
                    ->setAssociatedColumn('category_name')
            )
            ->add(
                (new Filter('cookie_name', TextType::class))
                    ->setTypeOptions([
                        'required' => false,
                        'attr' => [
                            'placeholder' => $this->trans('Cookie name', [], 'Modules.DsGprdCookie.Admin'),
                        ],
                    ])
                    ->setAssociatedColumn('cookie_name')
            )
            ->add(
                (new Filter('enabled', TextType::class))
                    ->setTypeOptions([
                        'required' => false,
                        'attr' => [
                            'placeholder' => $this->trans('Enabled', [], 'Modules.DsGprdCookie.Admin'),
                        ],
                    ])
                    ->setAssociatedColumn('enabled')
            )
            ->add(
                (new Filter('actions', SearchAndResetType::class))
                    ->setTypeOptions([
                        'reset_route' => 'admin_common_reset_search_by_filter_id',
                        'reset_route_params' => [
                            'filterId' => self::GRID_ID,
                        ],
                        'redirect_route' => 'ds_gprdcookie_cookie_index',
                    ])
                    ->setAssociatedColumn('actions')
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function getGridActions()
    {
        return (new GridActionCollection())
            ->add((new SimpleGridAction('common_refresh_list'))
                ->setName($this->trans('Refresh list', [], 'Admin.Advparameters.Feature'))
                ->setIcon('refresh')
            )
            ->add((new SimpleGridAction('common_show_query'))
                ->setName($this->trans('Show SQL query', [], 'Admin.Actions'))
                ->setIcon('code')
            )
            ->add((new SimpleGridAction('common_export_sql_manager'))
                ->setName($this->trans('Export to SQL Manager', [], 'Admin.Actions'))
                ->setIcon('storage')
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function getBulkActions()
    {
        return (new BulkActionCollection())
            ->add((new SubmitBulkAction('delete_bulk'))
                ->setName($this->trans('Delete selected', [], 'Admin.Actions'))
                ->setOptions([
                    'submit_route' => 'ds_gprdcookie_cookie_bulk_delete',
                    'confirm_message' => $this->trans('Delete selected items?', [], 'Admin.Notifications.Warning'),
                ])
            )
        ;
    }
}
