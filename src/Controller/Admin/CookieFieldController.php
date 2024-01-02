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

namespace DarkSide\DsGprdCookie\Controller\Admin;

use DarkSide\DsGprdCookie\Grid\Definition\Factory\CookieFieldGridDefinitionFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use DarkSide\DsGprdCookie\Grid\Filters\CookieFieldFilters;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShopBundle\Service\Grid\ResponseBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CookieFieldController extends FrameworkBundleAdminController
{
    /**
     * List quotes
     *
     * @param CookieFieldFilters $filters
     *
     * @return Response
     */
    public function indexAction(CookieFieldFilters $filters)
    {
        $cookieGridFactory = $this->get('darkside.module.dsgprd.grid.factory.cookies');
        $dsCookieGrid = $cookieGridFactory->getGrid($filters);

        return $this->render(
            '@Modules/dsgprdcookie/views/templates/admin/field/index.html.twig',
            [
                'enableSidebar' => true,
                'layoutTitle' => $this->trans('Cookies', 'Modules.DsGprdCookie.Admin'),
                'layoutHeaderToolbarBtn' => $this->getToolbarButtons(),
                'ds_cookie' => $this->presentGrid($dsCookieGrid),
            ]
        );
    }

    /**
     * Provides filters functionality.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function searchAction(Request $request)
    {
        /** @var ResponseBuilder $responseBuilder */
        $responseBuilder = $this->get('prestashop.bundle.grid.response_builder');

        return $responseBuilder->buildSearchResponse(
            $this->get('darkside.module.dsgprd.grid.definition.factory.cookies'),
            $request,
            CookieFieldGridDefinitionFactory::GRID_ID,
            'ds_gprdcookie_cookie_index'
        );
    }

    /**
     * Create quote
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $quoteFormBuilder = $this->get('darkside.module.dsgprd.form.identifiable_object.builder.cookie_form_builder');
        $quoteForm = $quoteFormBuilder->getForm();
        $quoteForm->handleRequest($request);

        $quoteFormHandler = $this->get('darkside.module.dsgprd.form.identifiable_object.handler.cookie_form_handler');
        $result = $quoteFormHandler->handle($quoteForm);

        if (null !== $result->getIdentifiableObjectId()) {
            $this->addFlash(
                'success',
                $this->trans('Successful creation.', 'Admin.Notifications.Success')
            );

            return $this->redirectToRoute('ds_gprdcookie_cookie_index');
        }

        return $this->render('@Modules/dsgprdcookie/views/templates/admin/field/create.html.twig', [
            'quoteForm' => $quoteForm->createView(),
        ]);
    }

    /**
     * Edit quote
     *
     * @param Request $request
     * @param int $quoteId
     *
     * @return Response
     */
    public function editAction(Request $request, $quoteId)
    {
        $quoteFormBuilder = $this->get('darkside.module.dsgprd.form.identifiable_object.builder.cookie_form_builder');
        $quoteForm = $quoteFormBuilder->getFormFor((int) $quoteId);
        $quoteForm->handleRequest($request);

        $quoteFormHandler = $this->get('darkside.module.dsgprd.form.identifiable_object.handler.cookie_form_handler');
        $result = $quoteFormHandler->handleFor((int) $quoteId, $quoteForm);

        if ($result->isSubmitted() && $result->isValid()) {
            $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

            return $this->redirectToRoute('ds_gprdcookie_cookie_index');
        }

        return $this->render('@Modules/dsgprdcookie/views/templates/admin/field/edit.html.twig', [
            'quoteForm' => $quoteForm->createView(),
        ]);
    }

    /**
     * Delete quote
     *
     * @param int $quoteId
     *
     * @return Response
     */
    public function deleteAction($quoteId)
    {
        $repository = $this->get('darkside.module.dsgprd.repository.cookie_repository');
        
        try {
            $quote = $repository->findOneById($quoteId);
        } catch (EntityNotFoundException $e) {
            $quote = null;
        }

        if (null !== $quote) {
            /** @var EntityManagerInterface $em */
            $em = $this->get('doctrine.orm.entity_manager');
            $em->remove($quote);
            $em->flush();

            $this->addFlash(
                'success',
                $this->trans('Successful deletion.', 'Admin.Notifications.Success')
            );
        } else {
            $this->addFlash(
                'error',
                $this->trans(
                    'Cannot find quote %quote%',
                    'Modules.Demodoctrine.Admin',
                    ['%quote%' => $quoteId]
                )
            );
        }

        return $this->redirectToRoute('ds_gprdcookie_cookie_index');
    }

    /**
     * Delete bulk quotes
     *
     * @param Request $request
     *
     * @return Response
     */
    public function deleteBulkAction(Request $request)
    {
        $quoteIds = $request->request->get('cookie_bulk');
        $repository = $this->get('darkside.module.dsgprd.repository.cookie_repository');
        try {
            $quotes = $repository->findById($quoteIds);
        } catch (EntityNotFoundException $e) {
            $quotes = null;
        }
        if (!empty($quotes)) {
            /** @var EntityManagerInterface $em */
            $em = $this->get('doctrine.orm.entity_manager');
            foreach ($quotes as $quote) {
                $em->remove($quote);
            }
            $em->flush();

            $this->addFlash(
                'success',
                $this->trans('The selection has been successfully deleted.', 'Admin.Notifications.Success')
            );
        }

        return $this->redirectToRoute('ds_gprdcookie_cookie_field_index');
    }

    /**
     * @return array[]
     */
    private function getToolbarButtons()
    {
        return [
            'add' => [
                'desc' => $this->trans('Add new cookie field', 'Modules.DsGprdCookie.Admin'),
                'icon' => 'add_circle_outline',
                'href' => $this->generateUrl('ds_gprdcookie_cookie_field_create'),
            ]
        ];
    }
}
