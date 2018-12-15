<?php

namespace WE\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WE\PlatformBundle\Entity\Image;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$entity = $builder->getData();
        //$entity = $options['data'];
        //print_r(array('advert_id' => $options->getId()));
        
        $builder
            //->add('url', TextType::class, array('label' => "L'url de l'image"))
            ->add('alt', TextType::class, array('label' => "Le titre de l'image"))
            ->add('file', FileType::class, array('label' => "Ajouter une image", 'required' => false))
            ->add('advert_id', HiddenType::class, array('attr' => array('value' => $options['advert_id'])))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WE\PlatformBundle\Entity\Image',
            'advert_id' => true
        ));
        //$resolver->setRequired(['advert_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'we_platformbundle_image';
    }


}
