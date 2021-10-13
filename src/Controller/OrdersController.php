<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\CountryLang;
use App\Entity\OrderDetail;
use App\Entity\Orders;
use App\Entity\OrderStateLang;
use App\Form\FilterType;
use App\Form\OrdersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class OrdersController extends AbstractController
{
    #[Route('/', name: 'orders_index', methods: ['GET','POST'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(FilterType::class);
        $form->handleRequest($request);
        $orders = null;
        $orderStateLangs = $this->getDoctrine()
            ->getRepository(orderStateLang::class)
            ->findAll();
        $orderDetails = $this->getDoctrine()
            ->getRepository(OrderDetail::class)
            ->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $filter = $form->get('filter')->getData();
            $value = $form->get('value')->getData();
            switch($filter){
                case "Country":
                    $country = $this->getDoctrine()
                        ->getRepository(CountryLang::class)
                        ->findOneBy(['name' => $value]);
                    $addresses = $this->getDoctrine()
                        ->getRepository(Address::class)
                        ->findBy(['idCountry' => $country]);
                    $orders = $this->getDoctrine()
                        ->getRepository(Orders::class)
                        ->findBy(array('idAddressDelivery' => $addresses));
                    break;
                case "State":
                    $state = $this->getDoctrine()
                        ->getRepository(OrderStateLang::class)
                        ->findOneBy(['name' => $value]);
                    $orders = $this->getDoctrine()
                        ->getRepository(Orders::class)
                        ->findBy(['currentState' => $state]);
                    break;
            }
        }else{
            $orders = $this->getDoctrine()
                ->getRepository(Orders::class)
                ->findAll();
        }
        return $this->render('orders/index.html.twig', [
            'form' => $form->createView(),
            'orders' => $orders,
            'orderDetails' => $orderDetails,
            'orderStateLangs' => $orderStateLangs,
        ]);
    }

    #[Route('/new', name: 'orders_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $order = new Orders();
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('orders_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('orders/new.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{idOrder}', name: 'orders_show', methods: ['GET'])]
    public function show(Orders $order): Response
    {
        return $this->render('orders/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/{idOrder}/edit', name: 'orders_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Orders $order): Response
    {
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orders_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('orders/edit.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{idOrder}', name: 'orders_update', methods: ['POST'])]
    public function updateState(Request $request, Orders $order): Response
    {
        $state = $request->request->get('state');
        $orderStateLang = $this->getDoctrine()
            ->getRepository(orderStateLang::class)
            ->findOneBy(['idOrderState' => $state]);
        $order->setCurrentState($orderStateLang);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('orders_index');
    }

    #[Route('/getValues', name: 'orders_filter', methods: ['GET'])]
    public function listFilterValues(Request $request): JsonResponse
    {
        $responseArray = array();
        switch($request->query->get("filter")){
            case "Country":
                $values = $this->getDoctrine()->getRepository(CountryLang::class)->findAll();
                foreach($values as $value){
                    $responseArray[] = array(
                        "id" => $value->getIdCountry(),
                        "name" => $value->getName()
                    );
                }
                break;
            case "State":
                $values = $this->getDoctrine()->getRepository(OrderStateLang::class)->findAll();
                foreach($values as $value){
                    $responseArray[] = array(
                        "id" => $value->getIdOrderState(),
                        "name" => $value->getName()
                    );
                }
                break;
        }
        return new JsonResponse($responseArray);
    }
}
