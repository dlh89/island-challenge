<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include 'IslandChallenge.php';

final class IslandChallengeTest extends TestCase
{
    public function testIslandCountCorrect(): void
    {
        $map = array(
            array(0, 0, 0, 0, 1),
            array(0, 0, 1, 0, 1),
            array(0, 0, 1, 0, 0),
            array(1, 1, 1, 0, 0),
            array(0, 0, 1, 0, 1),
        );

        $island_challenge = new IslandChallenge($map);
        $this->assertEquals(3, count($island_challenge->islands));
    }

    public function testMultipleIslandPrintDetails(): void
    {
        $map = array(
            array(0, 0, 0, 0, 1),
            array(0, 0, 1, 0, 1),
            array(0, 0, 1, 0, 0),
            array(1, 1, 1, 0, 0),
            array(0, 0, 1, 0, 1),
        );

        $island_challenge = new IslandChallenge($map);
        $island_details = $island_challenge->get_islands_details();
        $this->assertEquals('This map contains 3 islands.', $island_details);
    }

    public function testSingleIslandPrintDetails(): void
    {
        $map = array(
            array(0, 0, 1, 0, 0),
            array(0, 0, 1, 0, 0),
            array(0, 0, 1, 0, 0),
            array(1, 1, 1, 1, 1),
            array(0, 0, 1, 0, 0),
        );

        $island_challenge = new IslandChallenge($map);
        $island_details = $island_challenge->get_islands_details();
        $this->assertEquals('This map contains 1 island.', $island_details);
    }
}

