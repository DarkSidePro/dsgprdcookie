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

use Context;
use DarkSide\DsGprdCookie\Grid\Definition\Factory\CookieGridDefinitionFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use DarkSide\DsGprdCookie\Grid\Filters\CookieFilters;
use DarkSide\DsGprdCookie\Repository\CookieCategoryRepository;
use DarkSide\DsGprdCookie\Repository\CookieFieldRepository;
use DarkSide\DsGprdCookie\Repository\CookieRepository;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShopBundle\Service\Grid\ResponseBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CookieController extends FrameworkBundleAdminController
{
    /**
     * List cookies
     *
     * @param CookieFilters $filters
     *
     * @return Response
     */
    public function indexAction(CookieFilters $filters): Response
    {
        $cookieGridFactory = $this->get('darkside.module.dsgprd.grid.factory.cookies');
        $dsCookieGrid = $cookieGridFactory->getGrid($filters);

        return $this->render(
            '@Modules/dsgprdcookie/views/templates/admin/cookie/index.html.twig',
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
            CookieGridDefinitionFactory::GRID_ID,
            'ds_gprdcookie_cookie_index'
        );
    }

    /**
     * Create cookie
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $cookieFormBuilder = $this->get('darkside.module.dsgprd.form.identifiable_object.builder.cookie_form_builder');
        $cookieForm = $cookieFormBuilder->getForm();
        $cookieForm->handleRequest($request);

        $cookieFormHandler = $this->get('darkside.module.dsgprd.form.identifiable_object.handler.cookie_form_handler');
        $result = $cookieFormHandler->handle($cookieForm);

        if (null !== $result->getIdentifiableObjectId()) {
            $this->addFlash(
                'success',
                $this->trans('Successful creation.', 'Admin.Notifications.Success')
            );

            return $this->redirectToRoute('ds_gprdcookie_cookie_index');
        }

        return $this->render('@Modules/dsgprdcookie/views/templates/admin/cookie/create.html.twig', [
            'cookieForm' => $cookieForm->createView(),
        ]);
    }

    /**
     * Edit cookie
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        $cookieFormBuilder = $this->get('darkside.module.dsgprd.form.identifiable_object.builder.cookie_form_builder');
        $cookieForm = $cookieFormBuilder->getFormFor((int) $id);
        $cookieForm->handleRequest($request);

        $cookieFormHandler = $this->get('darkside.module.dsgprd.form.identifiable_object.handler.cookie_form_handler');
        $result = $cookieFormHandler->handleFor((int) $id, $cookieForm);

        if ($result->isSubmitted() && $result->isValid()) {
            $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

            return $this->redirectToRoute('ds_gprdcookie_cookie_index');
        }

        return $this->render('@Modules/dsgprdcookie/views/templates/admin/cookie/edit.html.twig', [
            'cookieForm' => $cookieForm->createView(),
        ]);
    }

    /**
     * Delete cookie
     *
     * @param int $cookieId
     *
     * @return Response
     */
    public function deleteAction($cookieId)
    {
        $repository = $this->get('darkside.module.dsgprd.repository.cookie_repository');
        
        try {
            $cookie = $repository->findOneById($cookieId);
        } catch (EntityNotFoundException $e) {
            $cookie = null;
        }

        if (null !== $cookie) {
            /** @var EntityManagerInterface $em */
            $em = $this->get('doctrine.orm.entity_manager');
            $em->remove($cookie);
            $em->flush();

            $this->addFlash(
                'success',
                $this->trans('Successful deletion.', 'Admin.Notifications.Success')
            );
        } else {
            $this->addFlash(
                'error',
                $this->trans(
                    'Cannot find cookie %cookie%',
                    'Modules.Demodoctrine.Admin',
                    ['%cookie%' => $cookieId]
                )
            );
        }

        return $this->redirectToRoute('ds_gprdcookie_cookie_index');
    }

    /**
     * Delete bulk cookies
     *
     * @param Request $request
     *
     * @return Response
     */
    public function deleteBulkAction(Request $request)
    {
        $cookieIds = $request->request->get('cookie_bulk');
        $repository = $this->get('darkside.module.dsgprd.repository.cookie_repository');
        try {
            $cookies = $repository->findById($cookieIds);
        } catch (EntityNotFoundException $e) {
            $cookies = null;
        }
        if (!empty($cookies)) {
            /** @var EntityManagerInterface $em */
            $em = $this->get('doctrine.orm.entity_manager');
            foreach ($cookies as $cookie) {
                $em->remove($cookie);
            }
            $em->flush();

            $this->addFlash(
                'success',
                $this->trans('The selection has been successfully deleted.', 'Admin.Notifications.Success')
            );
        }

        return $this->redirectToRoute('ds_gprdcookie_cookie_index');
    }

    /**
     * @return array[]
     */
    private function getToolbarButtons()
    {
        return [
            'add' => [
                'desc' => $this->trans('Add new cookie', 'Modules.DsGprdCookie.Admin'),
                'icon' => 'add_circle_outline',
                'href' => $this->generateUrl('ds_gprdcookie_cookie_create'),
            ]
        ];
    }

    /**
     * Generate script
     * 
     * @return Response
     */
    public function buildAction(): Response
    {
        $cookieRepository = $this->get('darkside.module.dsgprd.repository.cookie_repository');
        $cookieFieldRepository = $this->get('darkside.module.dsgprd.repository.cookie_field_repository');
        $cookieCategoryRepository = $this->get('darkside.module.dsgprd.repository.cookie_category_repository');

        $id_shop = Context::getContext()->shop->id;
        $id_lang = Context::getContext()->language->id;

        $cookies = $cookieRepository->findAllActiveCookiesByShopId(['id_shop' => $id_shop]);
        $fields = $cookieFieldRepository->findAll();
        $categories = $cookieCategoryRepository->findAll();
        

        return $this->render('@Modules/dsgprdcookie/views/templates/admin/cookie/build.html.twig', [
            'cookies' => $cookies,
            'fields' => $fields,
            'categories' => $categories
        ]);
    }
}
