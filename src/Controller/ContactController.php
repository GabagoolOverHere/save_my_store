<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $contact = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
              ->from($contact->get('email')->getData())
              ->to('timdevtestmail@gmail.com')
              ->subject($contact->get('object')->getData())
              ->htmlTemplate('emails/contact.html.twig')
              ->context([
                'message' => $contact->get('message')->getData(),
                'mail' => $contact->get('email')->getData(),
                'subject' => $contact->get('object')->getData(),
              ]);
            $mailer->send($email);

            $this->addFlash('message', 'Your email has been sent');

            return $this->redirectToRoute('home')
            ;
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
