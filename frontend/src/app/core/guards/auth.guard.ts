import {Injectable} from "@angular/core";
import {CanActivate, Router} from "@angular/router";
import {LocalStorageService} from "ngx-webstorage";

@Injectable()
export class AuthGuard implements CanActivate {

  constructor(private router: Router, private storage: LocalStorageService) {
  }

  canActivate() {
    const jwt = this.storage.retrieve('jwt');
    if (jwt) {
      return true;
    }
    this.router.navigateByUrl('login').then();
    return false;
  }
}
