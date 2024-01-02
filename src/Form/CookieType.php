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
use DarkSide\DsGprdCookie\Entity\DsGprdCookieCategory;
use Doctrine\ORM\EntityRepository;
use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\DefaultLanguage;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CookieType extends TranslatorAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $langId = Context::getContext()->language->id;
        $dbPrefix = _DB_PREFIX_;

        $builder
            ->add('cookie_service', TextType::class, [
                'label' => 'Cookie service',
                'help' => 'Display name for the cookie',
                'translation_domain' => 'Modules.DsgprdCookie.Admin',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 255,
                        'min' => 2,
                        'maxMessage' => $this->trans(
                            'This field cannot be longer than %limit% characters',
                            'Admin.Notifications.Error',
                            ['%limit%' => 255]
                        ),
                        'minMessage' => $this->trans(
                            'This field must be longer than %limit% characters',
                            'Admin.Notifications.Error',
                            ['%limit%' => 2]
                        ),
                    ])
                ]
            ])
            ->add('cookie_category', EntityType::class, [
                'label' => 'Cookie category',
                'help' => 'Cookie category from list',
                'translation_domain' => 'Modules.DsgprdCookie.Admin',
                'class' => DsGprdCookieCategory::class,
                'choice_label' => function (DsGprdCookieCategory $category) use ($langId) {
                    $categoryLang = $category->getCategoryLangForLang($langId);
            
                    // Dostosuj to do rzeczywistej nazwy metody lub właściwości w Twoim modelu
                    return $categoryLang ? $categoryLang->getCategoryName() : '';
                },
                'choice_value' => 'id',
                'query_builder' => function (EntityRepository $er) use ($langId) {
                    return $er->createQueryBuilder('c')
                        ->join('c.category_langs', 'cl')
                        ->andWhere('c.default_enabled = :enabled')
                        ->andWhere('cl.id_lang = :langId')
                        ->setParameter('langId', $langId)
                        ->setParameter('enabled', true)
                        ->orderBy('cl.category_name', 'ASC');
                },
            ])
            ->add('cookie_name', TextType::class, [
                'label' => 'De facto name of cookie',
                'help' => 'You can use regular expresion for exp. "/^_ga/". For mor about regex read here: https://en.wikipedia.org/wiki/Regular_expression',
                'required' => true, 
                'translation_domain' => 'Modules.DsgprdCookie.Admin',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 255,
                        'min' => 2,
                        'maxMessage' => $this->trans(
                            'This field cannot be longer than %limit% characters',
                            'Admin.Notifications.Error',
                            ['%limit%' => 500]
                        ),
                        'minMessage' => $this->trans(
                            'This field must be longer than %limit% characters',
                            'Admin.Notifications.Error',
                            ['%limit%' => 2]
                        ),
                    ])
                ]
            ])
            ->add('enabled', SwitchType::class, [
                'label' => 'Enabled',
                'help' => 'Turn off or turn on this cookie',
                'translation_domain' => 'Modules.DsgprdCookie.Admin',
                
            ])
            ->add('text_value', TranslatableType::class, [
                'label' => 'Descryption',
                'help' => 'Descrition for cookie in diffrent languages',
                'translation_domain' => 'Modules.DsgprdCookie.Admin',
                'constraints' => [
                    new DefaultLanguage([
                        'message' => $this->trans(
                            'The field %field_name% is required at least in your default language.',
                            'Admin.Notifications.Error',
                            [
                                '%field_name%' => sprintf(
                                    '"%s"',
                                    $this->trans('Descryption', 'Modules.DsgprdCookie.Admin')
                                ),
                            ]
                        ),
                    ]),
                ],
            ])
            ->add('script', TextareaType::class, [
                'label' => 'Script',
                'help' => 'Copy your script with this cookie',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 14,
                        'minMessage' => $this->trans(
                            'This field must be longer than %limit% characters',
                            'Admin.Notifications.Error',
                            ['%limit%' => 14]
                        ),
                    ])
                ]
            ])
            ->add('extra_script', TextareaType::class, [
                'label' => 'Extra script',
                'help' => 'Copy your extra script code with this cookie',
                'required' => false
            ])
            ->add('position', ChoiceType::class, [
                'choices' => [
                    'Header' => 'header',
                    'Footer' => 'footer'
                ],
                'translation_domain' => 'Modules.DsgprdCookie.Admin',
                'label' => 'Position',
                'help' => 'Choose where your script will be executed (header, footer)'
            ])
            ;
            
        ;
    }
}
