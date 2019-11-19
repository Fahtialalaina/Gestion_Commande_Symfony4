<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//my import class Name 
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class SecurityController extends AbstractController
{
    /**
     * @Route("/insription", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager)
    {
        $users = new Users();

        $form = $this->createForm(RegistrationType::class, $users);

        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ) {
            $manager->persist($users);
            $manager->flush();
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
