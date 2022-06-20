<?php

namespace IconicCodes\LightTest;

class LightTest {
    private $tests_array = [];
    private $results = [];

    public function __construct()
    {
    $header  = "\n";
    $header .= "    _    _      _   _  _____       _   \n";
    $header .= "    | |  (_)__ _| |_| ||_   _|__ __| |_ \n";
    $header .= "    | |__| / _` | ' \  _|| |/ -_|_-<  _|\n";
    $header .= "    |____|_\__, |_||_\__||_|\___/__/\__|\n";
    $header .= "           |___/                        \n\n";

    $header .= "    LightTest 1.0.0\n";
    $header .= "    Written By Nabeel Ali\n";
    $header .= "    https://iconiccodes.com\n\n\n";

    echo $header;
    }
    public function addTest(LTest $test) {
        $this->tests_array[] = $test;
    }

    public function run() {
        $pass = 0;
        $fail = 0;
        $total = 0;
        foreach ($this->tests_array as $test) {
            $test->handle();
            $this->results[] = $test->getId() . ': ' . $test->getStatus() ? 'Passed' : 'Failed';
            if ($test->getStatus()) {
                $pass++;
            } else {
                $fail++;
            }
            $total++;
        }

        $line1 = "Total Passed: $pass ";
        $line2 = "Total Failed: $fail ";

        $len_1 = strlen($line1);
        $len_2 = strlen($line2);

        if ($len_1 > $len_2) {
            $padding_c = $len_1 + 3;
        } elseif($len_1 == $len_2) {
            $padding_c = $len_1;
        } else {
            $padding_c = $len_2 + 3;
        }

        echo "\n";
        $padding = str_repeat(' ', $padding_c + 11);
   
        // Passed in green bg white text
        $pass_color = "\033[42m\033[37m";
        // Failed in red bg white text
        $fail_color = "\033[41m\033[37m";
        // Reset color
        $reset_color = "\033[0m";
    
        echo $pass_color . $padding . $reset_color . "\n";
        echo $pass_color . "  ✓  " . $line1 . '      '. $reset_color . "\n";
        echo $pass_color . $padding . $reset_color ."\n";
        echo $fail_color . $padding . $reset_color . "\n";
        echo $fail_color . "  ✘  " . $line2 . '      '. $reset_color . "\n";
        echo $fail_color . $padding;
        echo $reset_color;   
        echo "\n";
    }
}