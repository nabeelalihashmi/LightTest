<?php
use IconicCodes\LightTest\LightTest;
use IconicCodes\LightTest\LEqualityTest;
use IconicCodes\LightTest\LInstanceOfTest;
use IconicCodes\LightTest\LOutputEqualityTest;

include 'vendor/autoload.php';


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