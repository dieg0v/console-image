<?php namespace Dieg0v\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Intervention\Image\ImageManager;
use Hoathis\SymfonyConsoleBridge\Formatter\OutputFormatterStyle as Formatter;


class ImageExtractor extends Command {

    private $defaultWidth = 60;

    protected function configure() {
        $this->setName("image:extractor")
            ->setDescription("Pixels image to console")
            ->addArgument('url', InputArgument::REQUIRED)
            ->addArgument('width',InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $url = $input->getArgument('url');
        $w = ($input->getArgument('width')) ? $input->getArgument('width') : $this->defaultWidth;

        $manager = new ImageManager();

        try {

            $image = $manager->make($url);

            $image->resize($w, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $h =  $image->height();

            for ($j=0; $j<$h; $j++) {
                for ($i=0; $i<$w; $i++) {

                    $color = $image->pickColor($i, $j, 'hex');
                    $formatter = $output->getFormatter();
                    $formatter->setStyle('draw', new Formatter(null,$color));
                    $output->write("<draw> </draw>");

                }
                $output->writeln('');
            }
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
            $output->write($e->getMessage());
        }

    }
}

