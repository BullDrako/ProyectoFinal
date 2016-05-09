<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoriaType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('contenido', HiddenType::class, array(
                'data' =>'fggf'
            ))

            //->add('categorias', null, ['expanded' => true])
            ->add('nuevasCategorias')
            ->add('submit', SubmitType::class, [
                'label' => $options['submit_label'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'    => 'AppBundle\Entity\Publicacion',
            'submit_label'  => 'Nueva Categoria',
        ]);
    }

    public function getName()
    {
        return 'app_bundle_categoria_type2';
    }
}
