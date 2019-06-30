/**
 * Created by brasaeed on 29/06/2019.
 */
import {Injectable} from "@angular/core";
import {LocalStorageService} from "ngx-webstorage";
import {ApiService} from "../../service/api.service";
import {Observable} from "rxjs/index";
import {Pricing, PricingResponse, PricingsResponse} from "../../model/Responses";
@Injectable()
export class PricingRepo{

  constructor(private apiService: ApiService, private localStorage: LocalStorageService) {

  }

  getPricings(): Observable<Pricing[]> {
    return Observable.create((observer) => {
      const cachedPricings = this.localStorage.retrieve('pricings');
      const freshData = this.localStorage.retrieve('refresh_data.pricings') || !cachedPricings;
      if (!freshData) {
        observer.next(cachedPricings);
        observer.complete();
        return;
      }

      this.apiService.getPricings()
        .subscribe({
          next: (response: PricingsResponse) => {
            const pricings = response.pricings;
            this.localStorage.store('pricings', pricings);
            this.localStorage.store('refresh_data.pricings', false);
            observer.next(pricings);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  addPricing(pricing: Pricing): Observable<Pricing[]> {
    return Observable.create((observer) => {
      this.apiService.addPricing(pricing)
        .subscribe({
          next: (response: PricingResponse) => {
            const pricings = this.localStorage.retrieve('pricings') || [];
            const [oldPricing] = pricings.filter((cachedPricing: Pricing) => cachedPricing.id === response.pricing.id);
            pricings.splice(pricings.indexOf(oldPricing), 1, response.pricing);
            this.localStorage.store('pricings', pricings);
            observer.next(pricings);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  updatePricing(pricing): Observable<Pricing[]> {
    return Observable.create((observer) => {
      this.apiService.updatePricing(pricing)
        .subscribe({
          next: (response: PricingResponse) => {
            const pricings = this.localStorage.retrieve('pricings');
            const [oldPricing] = pricings.filter((cachedPricing: Pricing) => cachedPricing.id === response.pricing.id);
            pricings.splice(pricings.indexOf(oldPricing), 1, response.pricing);
            this.localStorage.store('pricings', pricings);
            observer.next(pricings);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  deletePricing(pricing: Pricing): Observable<Pricing[]> {
    return Observable.create((observer) => {
      this.apiService.deletePricing(pricing.id)
        .subscribe({
          next: () => {
            const pricings = this.localStorage.retrieve('pricings');
            const [oldPricing] = pricings.filter((cachedPricing: Pricing) => cachedPricing.id === pricing.id);

            pricings.splice(pricings.indexOf(oldPricing), 1);
            this.localStorage.store('pricings', pricings);
            observer.next(pricings);
            observer.complete();

          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

}
