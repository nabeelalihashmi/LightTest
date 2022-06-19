<?php

namespace IconicCodes\LightTest;

class LOutputEqualityTest extends LTest
{
    public function handle()
    {
        $this->__start(true);
        if ($this->getResult() == $this->expectedOutput) {
            $this->pass();
        } else {
            $this->fail();
        }
    }
}