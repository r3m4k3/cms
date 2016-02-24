<?php

namespace Cms\UtilBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Cms\UtilBundle\Mails\Message;

class SendMailsCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('mail:sendMails')
                ->setDescription('Wysyla maile. ');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $em = $this->getContainer()->get('doctrine')->getManager();
        $rep_users = $this->getContainer()->get('doctrine')->getRepository('CmsUserBundle:User');
        $rep_mails = $this->getContainer()->get('doctrine')->getRepository('CmsUtilBundle:Mail');
        $rep_mails_types = $this->getContainer()->get('doctrine')->getRepository('CmsUtilBundle:MailType');
        $mails = $rep_mails->findAll();

        foreach ($mails as $mail) {

            $user = $rep_users->find($mail->getUserId());
            if (!empty($user)) {
                $mail_type = $rep_mails_types->find($mail->getTypeId());
                $template_name = $mail_type->getTemplateName();
                $subject = $mail_type->getSubject();
                $context = $mail_type->getContext();
                $params = json_decode($mail->getParams(), true);

                $output->writeln('The mail was sent successfully. ');

                $m = new Message(
                        array(
                    'address' => $user->getEmail(),
                    'name' => $user->getUsername()
                        ), array(
                    'address' => $this->getContainer()->getParameter('mailer_user'),
                    'name' => $this->getContainer()->getParameter('mailer_name')
                        ), $subject, $this->getContainer()->get('templating')->render("Cms".$context."Bundle:Mails:$template_name.html.twig", $params)
                );

                $this->getContainer()->get('mailer')->send($m);
                
            }

            $em->remove($mail);
            $em->flush();
            $output->writeln('The mail record was deleted. ');
        }
    }

}
