<?php

namespace Cms\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteTokensCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('delete:deleteTokens')
                ->setDescription('Usuwa wygenerowane tokeny po 30 minutach od aktywacji');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $em = $this->getContainer()->get('doctrine')->getManager();
        $rep_token = $this->getContainer()->get('doctrine')->getRepository('CmsUserBundle:Token');
        $tokens = $rep_token->findAll();

        foreach($tokens as $token) {

            if(new \DateTime() > $token->getExpireDate()) {

                $em->remove($token);
                $em->flush();
                $output->writeln("User's token was deleted due to expiration of it. ");

            }

        }

    }

}
