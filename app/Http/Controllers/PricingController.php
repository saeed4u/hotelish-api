<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-26
 * Time: 15:44
 */

namespace App\Http\Controllers;


use App\Http\Requests\PricingRequest;
use App\Service\PricingService;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * @var PricingService $service
     */
    private $service;

    /**
     * PricingController constructor.
     * @param PricingService $service
     */
    public function __construct(PricingService $service)
    {
        $this->service = $service;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPricings()
    {
        return $this->service->getAll();
    }

    public function getPricing($id)
    {
        return $this->service->getPricing($id);
    }

    /**
     * @param PricingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPricing(PricingRequest $request)
    {
        $validated = $request->validated();
        return $this->service->addPricing($validated);
    }

    /**
     * @param PricingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePricing(PricingRequest $request)
    {
        $validated = $request->validated();
        return $this->service->updatePricing($request->pricing, $validated);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePricing(Request $request)
    {
        return $this->service->deletePricing($request->pricing);
    }

}