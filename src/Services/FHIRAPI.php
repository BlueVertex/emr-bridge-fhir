<?php

namespace BlueVertex\EMRBridgeFHIR\Services;

use BlueVertex\EMRBridge\Contracts\EMRAPI;
use Zttp\Zttp;
use Zttp\ZttpResponse;

class FHIRAPI implements EMRAPI
{
    public function getPatient($id)
    {
        return $this->makeGetRequest('Patient/' . $id, [
            '_format' => 'json',
            '_pretty' => true
        ])->json();
    }

    private function url($url)
    {
        return vsprintf('%s/%s', [
            getenv('FHIR_URL'),
            ltrim($url, '/'),
        ]);
    }

    private function makeGetRequest($url, $params = [])
    {
        return Zttp::get($this->url($url), $params);
    }
}
