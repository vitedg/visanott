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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\ORM\EntityManagerInterface;



class ProfilType extends AbstractType
{

  private $em;

    /**
     * The Type requires the EntityManager as argument in the constructor. It is autowired
     * in Symfony 3.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('profil_lib');
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
        ;
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();
        $agences = array();
        $profilParent = $this->em->getRepository('App\Entity\Profil')->find($data['profilParent']);
        $this->addElements($form, $profilParent);
    }

    function onPreSetData(FormEvent $event) {
        $profil = $event->getData();
        $form = $event->getForm();
        $profilParent = $profil->getProfilParent() ? $profil->getProfilParent() : null;
        $this->addElements($form, $profilParent);
    }


    protected function addElements( $form, Profil $profil = null) {
      $form
        ->add('profilParent',EntityType::class, [
          'class' => Profil::class,
          'query_builder' => function (EntityRepository $er) {
        return $er->createQueryBuilder('p')
            ->Where('p.profilParent IS NULL');
          },
          'choice_label' => function ($profil) {
              return $profil->getProfilLib();
          }]);
      $agences = array();
        if ($profil) {
          $repoAgences = $this->em->getRepository('App\Entity\Agence');
          $agences = $profil->getAgences()->getValues();

        }

        $form->add('agences', CollectionType::class, array(
          'entry_type' => EntityType::class,
            'required' => true,
            'allow_add' => true,
            'entry_options'=>
            ['choices' => $agences,'class' => Agence::class, 'choice_label' => 'id']
        ));
        $form->add('list_type_anomalies', EntityType::class, [
            'class'     => TypeAnomalies::class,
            'choice_label' => 'anomalie_lib',
            'query_builder' => function (EntityRepository $repo) {
                return $repo->createQueryBuilder('t');
                    //->where('t.id > :id')
                    //->setParameter('id', 1);
            },
            'label'     => "choisissez les types d'anomalies",
            'expanded'  => true,
            'multiple'  => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
            'allow_extra_fields' => true,
        ]);
    }
}
