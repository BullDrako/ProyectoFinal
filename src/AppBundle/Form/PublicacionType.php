<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class PublicacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenido'/*, TextType::class, array('data'=>' ¿León o Huevón?')*/)
            ->add('categorias', null, ['expanded' => true])
            //->add('nuevasCategorias')
            //->add('image', ImageType::class)

            ->add('publiFile', VichImageType::class,[
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['submit_label'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'    => 'AppBundle\Entity\Publicacion',
            'submit_label'  => 'Nueva Publicacion',
        ]);
    }

    public function getName()
    {
        return 'app_bundle_publicacion_type';
    }
}
