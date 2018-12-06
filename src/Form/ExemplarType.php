<?php

namespace App\Form;

use App\Entity\Exemplar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExemplarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('edicao')
            ->add('ano')
            ->add('ativo')
            ->add('livre')
            ->add('livro')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exemplar::class,
        ]);
    }
}
