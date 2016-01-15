<?php
namespace Grav\Plugin\Console;

use Grav\Console\ConsoleCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class LogCommand
 *
 * @package Grav\Plugin\Console
 */
class UrlCommand extends ConsoleCommand
{
    /**
     * @var string
     */
    protected $logfile;
    /**
     * @var array
     */
    protected $options = [];
    /**
     * @var array
     */
    protected $colors = [
        'DEBUG'     => 'green',
        'INFO'      => 'cyan',
        'NOTICE'    => 'yellow',
        'WARNING'   => 'yellow',
        'ERROR'     => 'red',
        'CRITICAL'  => 'red',
        'ALERT'     => 'red',
        'EMERGENCY' => 'magenta'
    ];

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName("url")
            ->setDescription("Hits a URL to precache")
            ->addArgument(
                'url',
                InputArgument::REQUIRED,
                'The URL of your site you want to use to preemptively popuplate cache'
            )
            ->setHelp('The <info>default command</info> hits a URL to precache')
        ;
    }

    /**
     * @return int|null|void
     */
    protected function serve()
    {

        $this->output->writeln('');
        $this->output->writeln('<magenta>Populating cache</magenta>');
        $this->output->writeln('');

        $this->getData($this->input->getArgument('url'));
        $this->output->writeln('Done.');
    }

    private function getData($url) {

        // force a trailing slash if there is none
        $url = rtrim($url, '/') . '/';

        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}

