<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Compteur;
use App\Entity\Produit;
use App\Entity\LCommande;
use App\Form\CommandeType;
use App\Form\LCommandeType;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commande")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/", name="commande_index", methods={"GET"})
     */
    public function index(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commande_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Compteur::class);
        $repository1 = $this->getDoctrine()->getRepository(Produit::class);
        $compteur = $repository->find(1);
        $numc = $compteur->getNumcom();
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        $lcommande = new LCommande();
        $f = $this->createForm(LCommandeType::class, $lcommande);
        $f->handleRequest($request);

        $session = $request->getSession();


        if(!$session->has('commande')){
            $session->set('commande',array());
        }
        $choix = "";
        $Tabcomm = $session->get('commande', []);

 
        if ($form->isSubmitted() || $f->isSubmitted()) {
            $choix = $request->get('bt');

            if($choix == 'Valider'){
                $em = $this->getDoctrine()->getManager();
                $lig = sizeof($Tabcomm);
                for($i = 1;$i<=$lig;$i++){
                    $lcommande = new LCommande();
                    $prod = $repository1->findOneBy(array('id'=>$Tabcomm[$i]->getProduit()));
                    $lcommande->setProduit($prod);
                    $lcommande->setLig($i);
                    $lcommande->setNumc($Tabcomm[$i]->getNumc());
                    $lcommande->setQte($Tabcomm[$i]->getQte());
                    $em->persist($lcommande);
                    $em->flush();
                }
                $commande->setNumc($numc);
                $em->persist($commande);
 
                $compteur->setNumcom($numc+1);
                $em->persist($compteur);
                $em->flush();

                
                $session->clear();

                return $this->redirectToRoute('commande_index');
            }
            else if($choix == "Add"){
                $lig = sizeof($Tabcomm)+1;
                $lcommande->setNumc($numc);
                $lcommande->setLig($lig);
                $Tabcomm[$lig] = $lcommande;
                $session->set('commande',$Tabcomm);
            }

            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($commande);
            // $entityManager->flush();

            // return $this->redirectToRoute('commande_index');
        }

        return $this->render('commande/new.html.twig', [
            'commande' => $commande,
            'lcommande' => $lcommande,
            // 'lig' => $lig,
            'numc' => $numc,
            'lcomm' => $Tabcomm,
            'form' => $form->createView(),
            'f' => $f->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_show", methods={"GET","POST"})
     */
    public function show(Commande $commande, $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(LCommande::class);
        $lcomm = $repository->findByComm($id);
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
            'lcomm' => $lcomm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commande $commande): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_index');
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commande $commande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_index');
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function supprimer($id,Request $request)
    {
        $session = $request->getSession();
        $Tabcomm = $session->get('commande', []);
        if(array_key_exists($id, $Tabcomm)){
            unset($Tabcomm[$id]);
            $session->set('commande',$Tabcomm);
        }
        return $this->redirectToRoute('commande_new');
    }
}
