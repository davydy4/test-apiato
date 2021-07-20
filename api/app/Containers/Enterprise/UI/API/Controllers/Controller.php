<?php

namespace App\Containers\Enterprise\UI\API\Controllers;

use App\Containers\Enterprise\Mail\EnterprisesQuotaEmail;
use App\Containers\Enterprise\Services\EnterpriseService;
use App\Containers\Enterprise\UI\API\Requests\GetAllEnterprisesRequest;
use App\Containers\Enterprise\UI\API\Transformers\EnterpriseTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Support\Facades\Mail;

class Controller extends ApiController
{
    protected $_service;

    public function __construct(EnterpriseService $service)
    {
        $this->_service = $service;
    }

    /**
     * Получить список предприятий
     * @param GetAllEnterprisesRequest $r
     * @return array
     */
    public function getAllEnterprises(GetAllEnterprisesRequest $r): array
    {
        $enterprises = $r->id ? $this->_service->getAllByParent($r->id) : $this->_service->getAll($r->search);

        return $this->transform($enterprises, EnterpriseTransformer::class);
    }

    /**
     * Найти предприятия с превышенной квотой и отправить список на email
     * @return array
     */
    public function getEnterprisesQuota(): array
    {
        $enterprises = $this->_service->getQuotaExceeded();
        if (! empty($enterprises))
        {
            if ($to = config('mail.to.support.address'))  {
                    Mail::to($to)
                        ->send(new EnterprisesQuotaEmail($enterprises));
            }

        }

        return $this->transform($enterprises, EnterpriseTransformer::class);
    }
}
