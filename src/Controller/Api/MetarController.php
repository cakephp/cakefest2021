<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Service\MetarService;
use Cake\Http\Response;

class MetarController extends AppController
{
    /**
     * @param string $icao ICAO
     * @return \Cake\Http\Response
     */
    public function get(?string $icao = null): Response
    {
        $this->request->allowMethod('get');

        $metarService = new MetarService();
        $metar = $metarService->get($icao);

        return $this->response
            ->withStatus(200)
            ->withStringBody(json_encode([
                'metar' => $metar,
            ]));
    }
}
