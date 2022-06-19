<?php

namespace IconicCodes\LightTest;

class LEqualityTest extends LTest {

    public function handle() {
        $this->__start();
        if ($this->getResult() == $this->expectedOutput) {
            $this->pass();
        } else {
            $this->fail();
        }
    }
}