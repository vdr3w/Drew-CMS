<?php
date_default_timezone_set('America/Sao_Paulo');
$dateTime = new DateTime();
echo $dateTime->format('d-m-Y H:i:s');