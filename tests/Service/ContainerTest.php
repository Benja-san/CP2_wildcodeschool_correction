<?php

use App\Service\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function setUp(): void
    {
        $this->container = new Container();
    }

    public function testInboxSmallOnly(): void
    {
        $this->assertEquals([0,0,1], $this->container->inbox(1));
        $this->assertEquals([0,0,1], $this->container->inbox(2));
    }   
    
    public function testInboxMiddleOnly(): void
    {
        $this->assertEquals([0,1,0], $this->container->inbox(3));
        $this->assertEquals([0,1,0], $this->container->inbox(4));
        $this->assertEquals([0,1,0], $this->container->inbox(5));
    }

    public function testInboxBigOnly(): void
    {
        $this->assertEquals([1,0,0], $this->container->inbox(6));
        $this->assertEquals([1,0,0], $this->container->inbox(7));
        $this->assertEquals([1,0,0], $this->container->inbox(8));
    } 
    
    public function testInboxMultipleBoxes(): void
    {
        $this->assertEquals([1,0,1], $this->container->inbox(9));
        $this->assertEquals([1,0,1], $this->container->inbox(10));
        $this->assertEquals([1,1,0], $this->container->inbox(11));
        $this->assertEquals([1,1,0], $this->container->inbox(12));
        $this->assertEquals([1,1,0], $this->container->inbox(13));
    }

    public function testMultipleBoxesOfSameSize(): void 
    {
        $this->assertEquals([2,0,0], $this->container->inbox(14));
        $this->assertEquals([2,0,0], $this->container->inbox(15));
        $this->assertEquals([2,0,0], $this->container->inbox(16));
        $this->assertEquals([2,0,1], $this->container->inbox(17));
        $this->assertEquals([2,0,1], $this->container->inbox(18));
        $this->assertEquals([2,1,0], $this->container->inbox(19));
        $this->assertEquals([2,1,0], $this->container->inbox(20));
    }
}

