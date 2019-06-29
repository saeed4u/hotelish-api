<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-26
 * Time: 15:39
 */

namespace App\Service;


use App\Hotel;
use App\Http\Resources\PricingResource;
use App\Pricing;
use Illuminate\Database\Eloquent\Collection;

class PricingService extends CrudService
{
    /**
     * @param array $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPricing(array $payload)
    {
        try {
            /**
             * @var Collection $pricingCollection
             */
            $pricingCollection = $this->repo->read(Pricing::where('room_type_id',$payload['room_type_id']));
            if ($pricingCollection->isEmpty()) {
                $pricing = new Pricing();
                //convert to cents
                $pricing->price = $payload['price'] * 100;
                $pricing->room_type_id = $payload['room_type_id'];
                $pricing->added_by = auth()->id();
            }else{
                $pricing = $pricingCollection->first();
                $pricing->price = $payload['price'];
            }

            if ($this->repo->create($pricing)) {
                return $this->success('Pricing created successfully',
                    ['pricing' => new PricingResource($pricing->refresh())]);
            }

        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    /**
     * @param $pricingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPricing($pricingId)
    {
        return $this->success('Pricing retrieved', ['pricing' =>new PricingResource(Pricing::find($pricingId))]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $pricings = Pricing::paginate(15);
        return $this->success('Pricings retrieved', ['pricings' => PricingResource::collection($pricings)]);
    }

    /**
     * @param Pricing $pricing
     * @param array $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePricing(Pricing $pricing, array $payload)
    {
        try {
            if ($this->repo->update($pricing, $payload)) {
                return $this->success('Pricing updated successfully',
                    ['pricing' => new PricingResource($pricing->refresh())]);
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    /**
     * @param Pricing $pricing
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePricing(Pricing $pricing)
    {
        try {
            if ($this->repo->delete($pricing)) {
                return $this->success();
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }
}