<?php

namespace App\Command;

use App\Interfaces\ParserDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ParserCommand
 *
 * @package App\Command
 */
class ParserCommand extends Command
{
    /**
     * @var ParserDispatcherInterface
     */
    private $parserDispacher;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ParserCommand constructor.
     *
     * @param ParserDispatcherInterface $parserDispacher
     * @param LoggerInterface $logger
     */
    public function __construct(ParserDispatcherInterface $parserDispacher, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->parserDispacher = $parserDispacher;

        parent::__construct();
    }

    protected static $defaultName = 'parser:run';

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setDescription('Run parsing process in CLI')
            ->setHelp('This command invokes without any parameters: use [bin/console parser:run] for execution.');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Run parsing ..... ');
        $this->parserDispacher->dispatch();
        $output->writeln('done.');

        return 0;
    }
}
