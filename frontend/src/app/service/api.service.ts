import {Injectable} from "@angular/core";
import {environment} from "../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs/index";
import {
  BaseResponse,
  Hotel,
  HotelResponse,
  LoginResponse, Pricing,
  Room, RoomResponse, RoomsResponse,
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

  public updateRoomType(roomType: RoomType): Observable<RoomTypeResponse> {
    return this.http.patch<RoomTypeResponse>(`${environment.baseApiUrl}/room-type/${roomType.id}`, roomType);
  }

  public deleteRoomType(roomTypeId: number): Observable<BaseResponse> {
    return this.http.delete<BaseResponse>(`${environment.baseApiUrl}/room-type/${roomTypeId}`);
  }

  public getRooms(): Observable<RoomsResponse> {
    return this.http.get<RoomsResponse>(`${environment.baseApiUrl}/room`);
  }

  public addRoom(room: Room): Observable<RoomResponse> {
    return this.http.post<RoomResponse>(`${environment.baseApiUrl}/room`, room);
  }

  public updateRoom(room: Room): Observable<RoomResponse> {
    return this.http.patch<RoomResponse>(`${environment.baseApiUrl}/room/${room.id}`, room);
  }

  public deleteRoom(roomId: number): Observable<BaseResponse> {
    return this.http.delete<BaseResponse>(`${environment.baseApiUrl}/room/${roomId}`);
  }


  public getPricings(): Observable<RoomsResponse> {
    return this.http.get<RoomsResponse>(`${environment.baseApiUrl}/pricing`);
  }

  public addPricing(pricing: Pricing): Observable<RoomResponse> {
    return this.http.post<RoomResponse>(`${environment.baseApiUrl}/pricing`, pricing);
  }

  public updatePricing(pricing: Pricing): Observable<RoomResponse> {
    return this.http.patch<RoomResponse>(`${environment.baseApiUrl}/pricing/${pricing.id}`, pricing);
  }

  public deletePricing(pricingId: number): Observable<BaseResponse> {
    return this.http.delete<BaseResponse>(`${environment.baseApiUrl}/pricing/${pricingId}`);
  }



}
