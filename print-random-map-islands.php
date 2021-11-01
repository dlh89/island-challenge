<?php
include 'IslandChallenge.php';

$island_challenge = new IslandChallenge();
$island_challenge->print_map();
$island_details = $island_challenge->get_islands_details();
echo $island_details;
