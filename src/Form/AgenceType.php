<?php

namespace App\Form;

use App\Entity\Agence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Direction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('agence_code')
            ->add('agence_lib')
            ->add('direction',EntityType::class, [
    'class' => Direction::class,
    'choice_label' => function ($direction) {
        return $direction->getDirectionLib();
		}])
			->add('save', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agence::class,
        ]);
    }
}
