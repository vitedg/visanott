<?php
namespace App\Form;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Role;
use App\Entity\Profil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RegistrationAdminNationalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('roles',ChoiceType::class,[
          'choices'=>[
            'ADMIN NATIONAL' => 'ROLE_ADMIN_NATIONAL',
          ],
          'multiple'=> true,
          'expanded'=>true
        ]);
    }

    public function getParent()
   {
       return BaseRegistrationFormType::class;
   }
}
