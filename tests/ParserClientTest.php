<?php

use PHPUnit\Framework\TestCase;
use App\Clients\ParserClient;
use App\Clients\ParserClientTerminal;
use App\Clients\ParserClientConfigurator;
use Symfony\Component\HttpClient\MockHttpClient;

/**
 * Class ParserClientTest
 */
class ParserClientTest extends TestCase
{
    public function testGetPostsLinksCollection()
    {
        $this->setDependencies([
            'parserObject' => new ParserClientTerminal(),
            'configuratorObject' => new ParserClientConfigurator(),
            'httpClientObject' => new MockHttpClient(),
        ]);

        $clientMock = $this->getMockBuilder(ParserClient::class)
            ->setMethods(['getPostsLinksCollection', 'updateClientContent'])
            ->setConstructorArgs([((object)$this->getDependencies())->parserObject])
            ->getMock();

        $clientMock
            ->method('updateClientContent')
            ->willReturn($this->returnValue(true));

        $this->assertIsArray(
            $clientMock->getPostsLinksCollection(
                ((object)$this->getDependencies())->configuratorObject,
                ((object)$this->getDependencies())->httpClientObject
            )
        );
    }

    public function testGetPostTitle()
    {
        $this->setDependencies([
            'parserObject' => new ParserClientTerminal(),
            'configuratorObject' => new ParserClientConfigurator(),
            'httpClientObject' => new MockHttpClient(),
        ]);

        $clientMock = $this->getMockBuilder(ParserClient::class)
            ->setMethods(['getPostTitle'])
            ->setConstructorArgs([((object)$this->getDependencies())->parserObject])
            ->getMock();

        $this->assertIsString(
            $clientMock->getPostTitle(
                ((object)$this->getDependencies())->configuratorObject,
                ((object)$this->getDependencies())->httpClientObject
            )
        );
    }

    public function testGetPostBody()
    {
        $this->setDependencies([
            'parserObject' => new ParserClientTerminal(),
            'configuratorObject' => new ParserClientConfigurator(),
            'httpClientObject' => new MockHttpClient(),
        ]);

        $clientMock = $this->getMockBuilder(ParserClient::class)
            ->setMethods(['getPostBody'])
            ->setConstructorArgs([((object)$this->getDependencies())->parserObject])
            ->getMock();

        $this->assertIsString(
            $clientMock->getPostBody(
                ((object)$this->getDependencies())->configuratorObject,
                ((object)$this->getDependencies())->httpClientObject
            )
        );
    }

    public function testGetPostImages()
    {
        $this->setDependencies([
            'parserObject' => new ParserClientTerminal(),
            'configuratorObject' => new ParserClientConfigurator(),
            'httpClientObject' => new MockHttpClient(),
        ]);

        $clientMock = $this->getMockBuilder(ParserClient::class)
            ->setMethods(['getPostImages'])
            ->setConstructorArgs([((object)$this->getDependencies())->parserObject])
            ->getMock();

        $this->assertIsArray(
            $clientMock->getPostImages(
                ((object)$this->getDependencies())->configuratorObject,
                ((object)$this->getDependencies())->httpClientObject
            )
        );
    }

    public function testUpdateClientContent()
    {
        $this->setDependencies([
            'parserObject' => new ParserClientTerminal(),
            'resourceUrl' => 'https://google.com',
            'httpClientObject' => new MockHttpClient(),
        ]);

        $clientMock = $this->getMockBuilder(ParserClient::class)
            ->setMethods(['updateClientContent'])
            ->setConstructorArgs([((object)$this->getDependencies())->parserObject])
            ->getMock();

        $this->assertEmpty(
            $clientMock->updateClientContent(
                ((object)$this->getDependencies())->httpClientObject,
                ((object)$this->getDependencies())->resourceUrl
            )
        );
    }
}
