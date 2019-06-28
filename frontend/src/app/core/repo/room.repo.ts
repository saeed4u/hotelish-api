import {Room, RoomResponse, RoomsResponse} from "../../model/Responses";
import {Observable} from "rxjs/index";
import {LocalStorageService} from "ngx-webstorage";
import {ApiService} from "../../service/api.service";
import {Injectable} from "@angular/core";
/**
 * Created by brasaeed on 28/06/2019.
 */

@Injectable()
export class RoomRepo{
  constructor(private apiService: ApiService, private localStorage: LocalStorageService) {

  }

  getRooms(): Observable<Room[]> {
    return Observable.create((observer) => {
      const cachedRooms = this.localStorage.retrieve('rooms');
      const freshData = this.localStorage.retrieve('fresh_data.rooms') || !cachedRooms;
      if (!freshData) {
        observer.next(cachedRooms);
        observer.complete();
        return;
      }

      this.apiService.getRooms()
        .subscribe({
          next: (response: RoomsResponse) => {
            const rooms = response.rooms;
            this.localStorage.store('rooms', rooms);
            observer.next(rooms);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  addRoom(room: Room): Observable<Room[]> {
    return Observable.create((observer) => {
      this.apiService.addRoom(room)
        .subscribe({
          next: (response: RoomResponse) => {
            const rooms = this.localStorage.retrieve('rooms') || [];
            rooms.push(response.room);
            this.localStorage.store('rooms', rooms);
            observer.next(rooms);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  updateRoom(room: Room): Observable<Room[]> {
    return Observable.create((observer) => {
      this.apiService.updateRoom(room)
        .subscribe({
          next: (response: RoomResponse) => {
            const rooms = this.localStorage.retrieve('rooms');
            const [oldRoom] = rooms.filter((cachedRoom: Room) => cachedRoom.id === response.room.id);
            rooms.splice(rooms.indexOf(oldRoom), 1, response.room);
            this.localStorage.store('rooms', rooms);
            observer.next(rooms);
            observer.complete();
          },
          error: err => {
            observer.error(err);
            observer.complete();
          }
        });

    });
  }

  deleteRoom(room: Room): Observable<Room[]> {
    return Observable.create((observer) => {
      this.apiService.deleteRoom(room.id)
        .subscribe({
          next: () => {
            const rooms = this.localStorage.retrieve('rooms');
            const [oldRoom] = rooms.filter((cachedRoom: Room) => cachedRoom.id === room.id);

            rooms.splice(rooms.indexOf(oldRoom), 1);
            this.localStorage.store('rooms', rooms);
            observer.next(rooms);
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
