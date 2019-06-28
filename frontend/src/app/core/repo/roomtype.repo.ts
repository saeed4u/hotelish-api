import {ApiService} from '../../service/api.service';
import {LocalStorageService} from 'ngx-webstorage';
import {Observable} from 'rxjs/index';
import {RoomType, RoomTypeResponse, RoomTypesResponse} from '../../model/Responses';
import {Injectable} from "@angular/core";

@Injectable()
export class RoomTypeRepo {

  constructor(private apiService: ApiService, private localStorage: LocalStorageService) {

  }

  getRooms(): Observable<RoomType[]> {
    return Observable.create((observer) => {
      const cachedRoomTypes = this.localStorage.retrieve('room_types');
      const freshData = this.localStorage.retrieve('fresh_data.room_types') || !cachedRoomTypes;
      if (!freshData) {
        observer.next(cachedRoomTypes);
        observer.complete();
        return;
      }

      this.apiService.getRoomTypes()
        .subscribe({
          next: (response: RoomTypesResponse) => {
            const roomTypes = response.room_types;
            this.localStorage.store('room_types', roomTypes);
            observer.next(roomTypes);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  addRoom(roomType: RoomType): Observable<RoomType[]> {
    return Observable.create((observer) => {
      this.apiService.addRoomType(roomType)
        .subscribe({
          next: (response: RoomTypeResponse) => {
            const roomTypes = this.localStorage.retrieve('room_types') || [];
            roomTypes.push(response.room_type);
            this.localStorage.store('room_types', roomTypes);
            observer.next(roomTypes);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  updateRoomType(roomType: RoomType): Observable<RoomType[]> {
    return Observable.create((observer) => {
      this.apiService.updateRoom(roomType)
        .subscribe({
          next: (response: RoomTypeResponse) => {
            const roomTypes = this.localStorage.retrieve('room_types');
            const [oldRoomType] = roomTypes.filter((cachedRoomType: RoomType) => cachedRoomType.id === response.room_type.id);
            roomTypes.splice(roomTypes.indexOf(oldRoomType), 1, response.room_type);
            this.localStorage.store('room_types', roomTypes);
            observer.next(roomTypes);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  deleteRoomType(roomType: RoomType): Observable<RoomType> {
    return Observable.create((observer) => {
      this.apiService.deleteRoom(roomType.id)
        .subscribe({
          next: () => {
            const roomTypes = this.localStorage.retrieve('room_types');
            const [oldRoomType] = roomTypes.filter((cachedRoomType: RoomType) => cachedRoomType.id === roomType.id);

            roomTypes.splice(roomTypes.indexOf(oldRoomType), 1);
            this.localStorage.store('room_types', roomTypes);
            observer.next(roomTypes);
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
