<?php

include_once 'Raffler.php';
include_once 'Output.php';
include_once 'Colors.php';

$raffler = new Raffler();
$raffler->addCompetitor('Enrico');
$raffler->addCompetitor('Danilo');
//$raffler->addCompetitor('Chris');
//$raffler->addCompetitor('Daniele A.');
//$raffler->addCompetitor('Ignazio');
//$raffler->addCompetitor('Fabrizio');
//$raffler->addCompetitor('Biagio');
//$raffler->addCompetitor('Davide');
//$raffler->addCompetitor('Alberto');
//$raffler->addCompetitor('Marcello M.');
$raffler->addCompetitor('Marcello V.');
$raffler->addCompetitor('Alessandro');

$raffler->run();
