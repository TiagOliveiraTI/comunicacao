<?php

use Otaodev\Infra\HomeController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(HomeController::class)]
final class HomeControllerTest extends TestCase
{

    private HomeController $sut;

    protected function setUp(): void
    {
        $this->sut = new HomeController;
    }

    public function testShouldReturnAString()
    {
        // Arrange
        $expected = 'alguma coisa' . PHP_EOL;

        // Act
        $sut = $this->sut->index();

        // Assert
        $this->assertEquals($expected, $sut);
    }
}
