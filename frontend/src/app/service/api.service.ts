import {Injectable} from "@angular/core";
import {environment} from "../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs/index";
import {
  BaseResponse,
  Hotel,
  HotelResponse,
  LoginResponse,
  RoomType,
  RoomTypeResponse,
  RoomTypesResponse
} from "../model/Responses";

@Injectable({
  providedIn: 'root'
})
export class ApiService {


  constructor(private http: HttpClient) {

  }

  public login(payload: object): Observable<LoginResponse> {
    return this.http.post<LoginResponse>(`${environment.baseApiUrl}/auth/login`, payload);
  }

  public getHotel(): Observable<HotelResponse> {
    return this.http.get<HotelResponse>(`${environment.baseApiUrl}/hotel`);
  }

  public updateHotel(hotel: Hotel): Observable<HotelResponse> {
    return this.http.patch<HotelResponse>(`${environment.baseApiUrl}/hotel`, hotel);
  }

  public getRoomTypes(): Observable<RoomTypesResponse> {
    return this.http.get<RoomTypesResponse>(`${environment.baseApiUrl}/room-type`);
  }

  public addRoomType(roomType: RoomType): Observable<RoomTypeResponse> {
    return this.http.post<RoomTypeResponse>(`${environment.baseApiUrl}/room-type`, roomType);
  }

  public updateRoom(roomType: RoomType): Observable<RoomTypeResponse> {
    return this.http.patch<RoomTypeResponse>(`${environment.baseApiUrl}/room-type/${roomType.id}`, roomType);
  }

  public deleteRoom(roomTypeId: number): Observable<BaseResponse> {
    return this.http.delete<BaseResponse>(`${environment.baseApiUrl}/room-type/${roomTypeId}`);
  }

}
