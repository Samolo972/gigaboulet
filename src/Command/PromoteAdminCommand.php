<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'promote-admin',
    description: 'Commande pour ajouter un admin',
)]
class PromoteAdminCommand extends Command
{
    protected static $defaultName = 'app:promote-admin';
    protected static $defaultDescription = 'Promote a user to admin by adding ROLE_ADMIN';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the user to promote')
            ->setHelp('This command allows you to promote a user to an admin by adding the ROLE_ADMIN role.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');

        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            $io->error("No user found with email: $email");
            return Command::FAILURE;
        }

        $roles = $user->getRoles();
        if (!in_array('ROLE_ADMIN', $roles, true)) {
            $roles[] = 'ROLE_ADMIN';
            $user->setRoles($roles);
            $this->entityManager->flush();

            $io->success("User {$user->getEmail()} has been promoted to admin.");
        } else {
            $io->info("User {$user->getEmail()} is already an admin.");
        }

        return Command::SUCCESS;
    }
}
