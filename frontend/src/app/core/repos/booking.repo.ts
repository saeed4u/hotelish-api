import {Injectable} from "@angular/core";
import {ApiService} from "../../service/api.service";
import {LocalStorageService} from "ngx-webstorage";
import {Booking, BookingResponse, BookingsResponse, PricingResponse} from "../../model/Responses";
import {Observable} from "rxjs/index";
/**
 * Created by brasaeed on 30/06/2019.
 */
@Injectable()
export class BookingRepo {

  constructor(private apiService: ApiService, private localStorage: LocalStorageService) {

  }

  getBookings(): Observable<Booking[]> {
    return Observable.create((observer) => {
      const cachedBookings = this.localStorage.retrieve('bookings');
      const freshData = this.localStorage.retrieve('refresh_data.bookings') || !cachedBookings;
      if (!freshData) {
        observer.next(cachedBookings);
        observer.complete();
        return;
      }

      this.apiService.getBookings()
        .subscribe({
          next: (response: BookingsResponse) => {
            const bookings = response.bookings;
            this.localStorage.store('bookings', bookings);
            this.localStorage.store('refresh_data.bookings', false);
            observer.next(bookings);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  addBooking(booking: Booking): Observable<Booking[]> {
    return Observable.create((observer) => {
      this.apiService.addBooking(booking)
        .subscribe({
          next: (response: BookingResponse) => {
            const bookings = this.localStorage.retrieve('bookings') || [];
            bookings.push(response.booking)
            this.localStorage.store('bookings', bookings);
            observer.next(bookings);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  updateBooking(booking): Observable<Booking[]> {
    return Observable.create((observer) => {
      this.apiService.updateBooking(booking)
        .subscribe({
          next: (response: BookingResponse) => {
            const bookings = this.localStorage.retrieve('bookings');
            const [oldBooking] = bookings.filter((cachedBooking: Booking) => cachedBooking.id === response.booking.id);
            bookings.splice(bookings.indexOf(oldBooking), 1, response.booking);
            this.localStorage.store('bookings', bookings);
            observer.next(bookings);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  deleteBooking(booking: Booking): Observable<Booking[]> {
    return Observable.create((observer) => {
      this.apiService.deleteBooking(booking.id)
        .subscribe({
          next: () => {
            const bookings = this.localStorage.retrieve('bookings');
            const [oldBooking] = bookings.filter((cachedBooking: Booking) => cachedBooking.id === booking.id);

            bookings.splice(bookings.indexOf(oldBooking), 1);
            this.localStorage.store('bookings', bookings);
            observer.next(bookings);
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
