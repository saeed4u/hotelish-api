import {Injectable} from "@angular/core";
import {environment} from "../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {Observable, of} from "rxjs/index";
import {LoginResponse} from "../model/Responses";
import {LocalStorageService} from "ngx-webstorage";
import {mergeMap} from "rxjs/internal/operators";

@Injectable({
  providedIn: 'root'
})
export class ApiService {


  constructor(private http: HttpClient, private localStorage: LocalStorageService) {

  }

  public login(payload: object): Observable<LoginResponse> {
    return this.http.post<LoginResponse>(`${environment.baseApiUrl}/auth/login`, payload);
  }

}
