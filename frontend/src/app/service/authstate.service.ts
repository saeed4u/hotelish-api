import {Injectable} from "@angular/core";
import {BehaviorSubject} from "rxjs";
import {LocalStorageService} from "ngx-webstorage";

@Injectable({
  providedIn: 'root'
})
export class AuthStateService {
  authState: BehaviorSubject<boolean>;

  constructor(private localStorage: LocalStorageService) {
    this.authState = new BehaviorSubject(localStorage.retrieve('jwt') || false);
  }

  public setLoggedInState(loggedIn: boolean) {
    this.authState.next(loggedIn);
    if (!loggedIn) {
      this.localStorage.clear();
    }
  }

}
