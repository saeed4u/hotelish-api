import {Injectable} from "@angular/core";
import {ApiService} from "../../service/api.service";
import {LocalStorageService} from "ngx-webstorage";
import {Observable} from "rxjs/index";
import {Hotel, HotelResponse} from "../../model/Responses";
/**
 * Created by brasaeed on 27/06/2019.
 */

@Injectable()
export class HotelRepo {
  constructor(private apiService: ApiService, private localStorage: LocalStorageService) {

  }

  getHotel(): Observable<Hotel> {
    const cachedHotel = this.localStorage.retrieve('hotel');
    const freshData = this.localStorage.retrieve('refresh_data.hotel');
    const newData = freshData || !cachedHotel;
    return Observable.create((observer) => {
      if (!newData) {
        observer.next(cachedHotel);
        observer.complete();
        return;
      }
      this.apiService.getHotel()
        .subscribe({
          next: (value: HotelResponse) => {
            this.localStorage.store('refresh_data.hotel', false);
            const hotel = value.hotel;
            observer.next(hotel);
            observer.complete();
            this.localStorage.store('hotel', hotel);
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });
    });
  }

  updateHotel(hotel: Hotel): Observable<Hotel> {
    return Observable.create((observer) => {

      this.apiService.updateHotel(hotel)
        .subscribe({
          next: (response: HotelResponse) => {
            const updatedHotel = response.hotel;
            this.localStorage.store('hotel', updatedHotel);
            observer.next(updatedHotel);
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
