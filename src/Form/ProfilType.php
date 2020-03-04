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
use App\Entity\TypeAnomalies;


class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('profil_lib')
            ->add('profilParent',EntityType::class, [
    'class' => Profil::class,
    'choice_label' => function ($profil) {
        return $profil->getProfilLib();
		}])
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
            ->add('list_type_anomalies', EntityType::class, [
                'class'     => TypeAnomalies::class,
                'choice_label' => 'anomalie_lib',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->where('f.id > :id')
                        ->setParameter('id', 1);
                },
                'label'     => 'choisissez la liste de types anomalies',
                'expanded'  => true,
                'multiple'  => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
