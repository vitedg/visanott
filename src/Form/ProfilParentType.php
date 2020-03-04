<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Agence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ProfilParentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('profil_lib')
            ->add('agences', EntityType::class, [
                'class'     => Agence::class,
                'choice_label' => 'agence_lib',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->where('f.id > :id')
                        ->setParameter('id', 1);
                },
                'label'     => "choisissez l'agence",
                'expanded'  => true,
                'multiple'  => true,
            ])
          ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
