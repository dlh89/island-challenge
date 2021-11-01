<?php

/**
 * https://github.com/rossmoneyfreelancer/islands/blob/main/Our%20People%20-%20PHP%20Challenge.md
 */
class IslandChallenge
{
    const ROWS = 5;
    const COLUMNS = 5;

    public $map = array();
    public $islands = array();
    public $counted_island_cells = array();
    public $island_cells = array();

    public function __construct()
    {
        $this->build_map();
        // $this->build_test_map();
        $this->print_map();
        $this->set_islands();
        $this->print_islands_details();
    }

    private function build_map()
    {
        for ($i = 0; $i < $this::ROWS; $i++) {
            $row_array = [];
            for ($j = 0; $j < $this::COLUMNS; $j++) {
                $cell_value = rand(0, 1);
                $row_array[] = $cell_value;
            }
            $this->map[] = $row_array;
        }
    }

    private function build_test_map()
    {
        $this->map = array(
            array(0, 0, 0, 0, 1),
            array(0, 0, 1, 0, 1),
            array(0, 0, 1, 0, 0),
            array(1, 1, 1, 0, 0),
            array(0, 0, 1, 0, 1),
        );
    }

    private function print_map()
    {
        echo "map:\n";
        foreach ($this->map as $array) {
            foreach ($array as $cell) {
                echo $cell . ',';
            }
            echo "\n";
        }
    }

    private function set_islands()
    {
        $this->set_island_cells();
        foreach ($this->island_cells as $island_cell) {
            if (!in_array($island_cell, $this->counted_island_cells))
            {
                $this_island = array($island_cell); // initialise the island with just the current cell
                $this->counted_island_cells[] = $island_cell;
                $this->set_this_island($this_island);
            }
        }
    }

    private function set_island_cells()
    {
        for ($i = 0; $i < $this::ROWS; $i++) {
            for ($j = 0; $j < $this::COLUMNS; $j++) {
                $is_island_cell = $this->map[$i][$j] === 1;
                if ($is_island_cell) {
                    $current_cell_coordinates = array($i, $j);
                    $this->island_cells[] = $current_cell_coordinates;
                }
            }
        }
    }

    /**
     * Loop through each island cell checking for any cells connected to the given island
     * Recursively call itself whenever we add a new connection to this island
     * Add the completed island to $this->islands array
     *
     * @param array $this_island_cell
     * @return void
     */
    private function set_this_island($this_island)
    {
        // loop through all island cells checking for connections
        foreach ($this->island_cells as $island_cell) {
            $is_connected = $this->is_connected($this_island, $island_cell);
            if ($is_connected && !in_array($island_cell, $this->counted_island_cells)) {
                $this->counted_island_cells[] = $island_cell;
                $this_island[] = $island_cell;

                // we've added a new connection so we need to recursively restart the loop
                $this->set_this_island($this_island);
                return;
            }
        }

        $this->islands[] = $this_island;
    }

    /**
     * Check if any of the cells in this island are connected to this cell
     * i.e. directly beside or above or below
     *
     * @param array $this_island e.g. array(array(0, 4), array(1, 4))
     * @param array $this_cell e.g. array(0, 2)
     * @return boolean
     */
    private function is_connected($this_island, $this_island_cell)
    {
        foreach ($this_island as $island_cell) {
            $is_same_row = $island_cell[0] === $this_island_cell[0];
            $is_same_col = $island_cell[1] === $this_island_cell[1];

            // same col and same row plus or minus 1
            $is_row_connected = ($island_cell[0] + 1 === $this_island_cell[0] ||  $island_cell[0] - 1 === $this_island_cell[0]) && $is_same_col;
            // same row and same col plus or minus 1
            $is_col_connected = ($island_cell[1] + 1 === $this_island_cell[1] || $island_cell[1] - 1 === $this_island_cell[1]) && $is_same_row;

            if ($is_row_connected || $is_col_connected) {
                return true;
            }
        }

        return false;
    }

    private function print_islands_details()
    {
        $noun = count($this->islands) === 1 ? 'island' : 'islands';
        echo 'This map contains ' . count($this->islands) . ' ' . $noun . '.';
        echo "\n\n";
        print_r($this->islands);
    }
}

$island_challenge = new IslandChallenge;
