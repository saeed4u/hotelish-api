import {Injectable} from "@angular/core";
import {ApiService} from "../../service/api.service";
import {LocalStorageService} from "ngx-webstorage";
import {Observable, Observer} from "rxjs/index";
/**
 * Created by brasaeed on 27/06/2019.
 */

@Injectable()
export class DashboardRepo {
  constructor(private apiService: ApiService, private localStorage: LocalStorageService) {

  }

  getUser() {
    return Observable.create((observer: Observer) => {
      const user = this.localStorage.retrieve('user');
      if (user) {
        observer.next(JSON.parse(user));
        observer.complete();
      } else {
        //todo get user from api
      }
    });
  }

}
