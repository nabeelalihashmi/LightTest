<?php

namespace IconicCodes\LightTest;

abstract class LTest implements ITest {
    protected $expectedOutput;
    protected $uniqid;
    protected $result;
    private   $status;
    protected $message;
    protected $callback;
    protected $calculateSimilarity;

    public function __construct($expectedOutput, $callback, $message, $calculateSimilarity = false) {
        $this->expectedOutput = $expectedOutput;
        $this->uniqid = uniqid();
        $this->message = $message;
        $this->callback = $callback;
        $this->calculateSimilarity = $calculateSimilarity;
    }

    
    protected function __start($capture = false) {

        $line1 = "Test Id: {$this->uniqid}" ;

        echo "$line1  \n";
        echo $this->message . "\n";

        $timeBeforeTest = microtime(true);

        if ($capture) {
            ob_start();
            ($this->callback)();
            $this->result = ob_get_clean();
        } else {
            $this->result = ($this->callback)();
        }

        $timeAfterTest = microtime(true);

        $testTime = number_format($timeAfterTest - $timeBeforeTest, 20);
        echo "Time Taken: $testTime Seconds\n";

        $this->runAfter();

        echo "Expected Result: \n{$this->expectedOutput}\n";
        echo "Output Result: \n{$this->result}\n";

        $similarity = $this->getSimilarity();
        $padding = str_repeat(' ', strlen($similarity) + 15);
        
        // echo "\033[45m\033[37m\033[1m $padding \033[0m\n";
        // echo "\033[45m\033[37m\033[1m  Similarity: $similarity%  \033[0m\n";
        // echo "\033[45m\033[37m\033[1m $padding \033[0m\n";

        echo "Similarity: $similarity%\n";
    }

    protected function runAfter() {

    }

    protected function getSimilarity() {
        $output = $this->result;
        $expected = $this->expectedOutput;
        $output = strtolower($output);
        $expected = strtolower($expected);
        $output = preg_replace('/\s+/', '', $output);
        $expected = preg_replace('/\s+/', '', $expected);
        $output = preg_replace('/[^a-zA-Z0-9]/', '', $output);
        $expected = preg_replace('/[^a-zA-Z0-9]/', '', $expected);
        $output = str_split($output);
        $expected = str_split($expected);
        $similarity = 0;
        $len = min(count($output), count($expected));
        for ($i = 0; $i < $len; $i++) {
            if ($output[$i] == $expected[$i]) {
                $similarity++;
            }
        }
        $s = $similarity / $len;
        return number_format($s * 100, 2);

    }

    public function getId() {
        return $this->uniqid;
    }

    protected function getResult() {
        return $this->result;
    }

    public function getStatus() {
        return $this->status;
    }

    protected function pass($text = 'PASSED') {
        $padding = str_repeat(' ', strlen($text) + 20);

        echo "\033[42m\033[37m\033[1m$padding \033[0m\n";
        echo "\033[42m\033[37m\033[1m        ✓  $text          \033[0m\n";
        echo "\033[42m\033[37m\033[1m$padding \033[0m\n\n\n";
        $this->status = true;
    }
    protected function fail($text = 'FAILED') {
        $padding = str_repeat(' ', strlen($text) + 20);
        echo "\033[41m\033[37m\033[1m$padding \033[0m\n";
        echo "\033[41m\033[37m\033[1m         ✘  $text         \033[0m\n";
        echo "\033[41m\033[37m\033[1m$padding \033[0m\n\n\n";

        //
        $this->status = false;
    }
    
}
