<?php

include __DIR__ . '/../vendor/autoload.php';

ini_set('memory_limit', '-1');

$train = new \RicardoKovalski\Frauder\Train('datasets/creditcard.csv');

$train->train();