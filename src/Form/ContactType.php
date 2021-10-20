<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{

    /**
     * Permet d'avoir la configuration de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return[
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
            ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, $this->getConfiguration("Nom","Tapez votre nom"))
        ->add('prenom', TextType::class, $this->getConfiguration("Prenom", "Donnez votre prenom"))
        ->add('adresse', TextType::class, $this->getConfiguration("Adresse", "Indiquez votre adresse"))
        ->add('codepostal', TextType::class, $this->getConfiguration("Code postale", "Indiquez votre code postal"))
        ->add('ville', TextType::class, $this->getConfiguration("Ville", "Indiquez votre nom de ville"))
        ->add('numTel', TextType::class, $this->getConfiguration("Numero de telephone", "Indiquez votre numero de telephone"))
        ->add('adresseMail', TextType::class, $this->getConfiguration("Adresse email", "Indiquez votre adresse email"))
        ->add('urlAvatar', UrlType::class, $this->getConfiguration("Url de l'image d'avatar", "Indiquez l'url de votre avatar"))
        ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'designation',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}