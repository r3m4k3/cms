<?php

namespace Cms\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteUsersCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('delete:deleteUsers')
                ->setDescription('Usuwa userów z nieaktywowanym kontem po 3 dniach');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $em = $this->getContainer()->get('doctrine')->getManager();
        $rep_user = $this->getContainer()->get('doctrine')->getRepository('CmsUserBundle:User');
        $users = $rep_user->findAll();

        foreach($users as $user) {

            $time_to_activate = $user->getCreated()->add(new \DateInterval('PT72H'));

            if($user->getActivated() === null) {
                if(new \DateTime() > $time_to_activate) {

                        $em->remove($user);
                        $em->flush();
                        $output->writeln('User account was deleted due to unactivation. ');

                    }
            }

        }
    }

}
