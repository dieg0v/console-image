<?php

use Dieg0v\Console\Command\ImageExtractor;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ImageExtractorTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new ImageExtractor());

        $command = $application->find('image:extractor');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array('command' => $command->getName(),
                'url' => 'https://lh4.googleusercontent.com/-bEK_wXdSd-g/AAAAAAAAAAI/AAAAAAAAAOk/Nova96CPLSY/photo.jpg'
        ));

        $data = $commandTester->getDisplay();

        $this->assertInternalType("string", $data);
        $this->assertEquals(3660, strlen($data));

    }

    public function testBadUrl()
    {
        $application = new Application();
        $application->add(new ImageExtractor());

        $command = $application->find('image:extractor');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array('command' => $command->getName(),
                'url' => 'bar-url'
        ));

        $data = $commandTester->getDisplay();
        $this->assertEquals('Image source not readable', $data);

    }

    /**
     * @dataProvider provider
     */
    public function testProviders( $url, $width, $pixeles)
    {
        $application = new Application();
        $application->add(new ImageExtractor());

        $command = $application->find('image:extractor');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array('command' => $command->getName(),
                'url' => $url,
                'width' => $width
        ));

        $data = $commandTester->getDisplay();

        $this->assertInternalType("string", $data);
        $this->assertEquals($pixeles, strlen($data));

    }

    public function provider()
    {
        return array(
          array('url' => 'https://lh4.googleusercontent.com/-bEK_wXdSd-g/AAAAAAAAAAI/AAAAAAAAAOk/Nova96CPLSY/photo.jpg',
                'width' => 100,
                'pixeles' => 10100
          ),
          array('url' => 'https://pbs.twimg.com/profile_images/464363026674495488/cX1R83tB.png',
                'width' => 60,
                'pixeles' => 3660
          ),
          array('url' => 'https://avatars1.githubusercontent.com/u/167553?s=140',
                'width' => 40,
                'pixeles' => 1640
          ),
          array('url' => 'https://lh4.googleusercontent.com/-bEK_wXdSd-g/AAAAAAAAAAI/AAAAAAAAAOk/Nova96CPLSY/photo.jpg',
                'width' => 80,
                'pixeles' => 6480
          )
        );
    }

}
