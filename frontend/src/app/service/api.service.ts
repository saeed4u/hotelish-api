import {Injectable} from "@angular/core";
import {environment} from "../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs/index";
import {Hotel, HotelResponse, LoginResponse} from "../model/Responses";

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
    return this.http.get<HotelResponse>(`${environment.baseApiUrl}/admin/hotel`);
  }

  public updateHotel(hotel: Hotel): Observable<HotelResponse> {
    return this.http.patch<HotelResponse>(`${environment.baseApiUrl}/admin/hotel`, hotel);
  }

}
