import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthstateService {
 authState: BehaviorSubject<boolean>;

 constructor() {
  this.authState = new BehaviorSubject(false);
 }

  public setLoggedInState(loggedIn: boolean) {
    this.authState.next(loggedIn);
  }

}
