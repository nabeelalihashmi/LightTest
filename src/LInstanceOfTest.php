<?php

namespace IconicCodes\LightTest;

class LInstanceOfTest extends LTest
{
    public function runAfter() {
        $this->result = gettype($this->result);
    }
    public function handle()
    {
        $this->__start();
        if ($this->getResult() == $this->expectedOutput) {
            $this->pass();
        } else {
            $this->fail();
        }
    }
}