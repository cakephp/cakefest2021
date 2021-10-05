<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Http\Client;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;

/**
 * Description
 */
class MetarService
{
    /**
     * @var string
     */
    // phpcs:ignore
    protected $_metarSourceUrl = 'https://www.aviationweather.gov/adds/dataserver_current/httpparam?dataSource=metars&requestType=retrieve&format=xml&hoursBeforeNow=1';

    /**
     * @param string $icao ICAO
     * @return string
     */
    public function get(?string $icao = null): string
    {
        if (empty($icao)) {
            throw new BadRequestException('No ICAO code passed');
        }

        $client = new Client();
        $response = $client->get($this->_metarSourceUrl, [
            'stationString' => $icao,
        ]);
        if ($response->isOk()) {
            $xml = $response->getXml();
            foreach ($xml->data->METAR as $metar) {
                return (string)$metar->raw_text;
            }
        }

        throw new NotFoundException('No METAR found');
    }
}
