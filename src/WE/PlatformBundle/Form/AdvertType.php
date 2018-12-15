<?php

namespace WE\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use WE\PlatformBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pattern = 'D%';
        $builder
            ->add('date', DateType::class, array('label' => "Date de l'annonce"))
            ->add('title', TextType::class, array('label' => 'Le titre'))
            ->add('content', TextareaType::class, array('label' => 'Le contenu'))
            ->add('author', TextType::class, array('label' => "L'auteur"))
            //->add('published', CheckboxType::class, array('label' => 'Afficher publiquement ?', 'required' => false))
            //->add('image', ImageType::class)
            /*->add('categories', CollectionType::class, array(
                'entry_type' => CategoryType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))*/
            ->add('categories', EntityType::class, array(
                'class' => 'WEPlatformBundle:Category',
                'choice_label' => 'name',
                'multiple' => true, // false = combobox (unique selection), true = select multiple
                //'expanded' => true,
                /*'query_builder' => function(CategoryRepository $repository) use($pattern) {
                    return $repository->getLikeQueryBuilder($pattern);
                }*/
            ))
            ->add('save', SubmitType::class)
        ;
            
        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
                // On récupère notre objet Advert sous-jacent
                $advert = $event->getData();
                // Cette condition est importante, on en reparle plus loin
                if (null === $advert) 
                    return; // On sort de la fonction sans rien faire lorsque $advert vaut null
                
                // Si l'annonce n'est pas publiée, ou si elle n'existe pas encore en base (id est null)
                if (!$advert->getPublished() || null === $advert->getId()) {
                    // Alors on ajoute le champ published
                    $event->getForm()->add('published', CheckboxType::class, array('label' => 'Afficher publiquement ?', 'required' => false));
                } else {
                    // Sinon, on le supprime
                    $event->getForm()->remove('published');
                }
            }
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WE\PlatformBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'we_platformbundle_advert';
    }


}
