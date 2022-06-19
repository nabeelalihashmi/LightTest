![LightTest](./docs/header.png)

# LightTest

An easy to use extensible testing system for PHP .
## About Author
[Nabeel Ali](https://iconiccodes.com)

Website: [https://iconiccodes.com](https://iconiccodes.com)

Email: [mail2nabeelali@gmail.com](mailto:mail2nabeelali@gmail.com)

## Features

    * Fast
    * Easy
    * Extensible


## Installtion
```
composer require nabeelalihashmi/LightTest
```

## Basic Usage

### Creating Test

First, create object of test type class (e.g `LEqualityTest`).

A test required 3 arguments, `expected output`, `callback` and `message`.

Callback must be a function argument. You can call other functions in this function.

### Test

Now, create the LightTest object and add the tests.

Call `run` method to run the tests.


```

function getName() {
    return 'Nabeel Ali';
}
function getName2() {
    return 'Not Nabeel Ali but Nabeel Ali';
}

function getAge() {
    return 28;
}
function getAgeWrong() {
    return "28";
}

function printName() {
    echo 'Nabeel';
}

$test1 = new LEqualityTest('Nabeel Ali', function() { return getName(); }, "Test First Name");
$test2 = new LEqualityTest('Nabeel Ali', function() { return getName2(); }, "Testing Second Name");
$test3 = new LInstanceOfTest('string', function() { return getName(); }, "Testing If Name is a string");
$test4 = new LInstanceOfTest('integer', function() { return getAge(); }, "Testing if Age is an integer");
$test5 = new LInstanceOfTest('integer', function() { return getAge(); }, "Testing if Age is an integer");
$test6 = new LOutputEqualityTest('Nabeel', function() {  printName(); }, "Testing output of printName()");

$lt = new LightTest();
$lt->addTest($test1);
$lt->addTest($test2);
$lt->addTest($test3);
$lt->addTest($test4);
$lt->addTest($test5);
$lt->addTest($test6);
$lt->run();

```

## Available Tests

By default, LightTest has these tests
### Equality Test
Check Values of Callback for Equality with Expected Value

### Instance Check Test
Check if Callback returns an instance that matches expected argument.

### Output Check Test
Check if Callback prints expected output.

## Make Own Test Handler

You can make your own test handler by extending the `LTestClass` class. You need to implement the `handle` method.

Optionally, you can also implement the `runAfter` method. This method is executed after the execution of callback and it is to modify result. 

In `handle` method, you can use 
`$this->getResult()` and `$this->exprectedOutput`.

if test passes, call `$this->pass()` else call `$this->fail()`

```
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
```

-------------------------

## License

LightTest is released under permissive licese with following conditions:

* It cannot be used to create adult apps.
* It cannot be used to gambling apps.
* It cannot be used to create apps having hate speech.

### MIT License

Copyright 2022 Nabeel Ali | IconicCodes.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

