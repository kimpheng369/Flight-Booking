<?php
$json = json_decode(file_get_contents('https://raw.githubusercontent.com/mwgg/Airports/master/airports.json'), true);
foreach ($json as $k => $v) {
    if (($v['iata'] ?? '') === 'CDG' || ($v['iata'] ?? '') === 'JFK' || ($v['iata'] ?? '') === 'PNH') {
        echo "KEY: $k => IATA: {$v['iata']}, City: {$v['city']}, Country: {$v['country']}\n";
    }
}
