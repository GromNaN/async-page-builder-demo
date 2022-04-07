<?php

namespace App\Page\Block;

use App\ApiClient;
use Symfony\Contracts\Service\Attribute\Required;

trait WithApiClient
{
    private ApiClient $apiClient;

    #[Required]
    public function setApiClient(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }
}
