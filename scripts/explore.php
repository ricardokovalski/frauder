<?php

include __DIR__ . '/../vendor/autoload.php';

ini_set('memory_limit', '-1');

$explore = new \RicardoKovalski\Frauder\Explore('datasets/creditcard.csv');

$explore->explore();