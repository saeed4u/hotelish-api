import {Injectable} from "@angular/core";
import {CanActivate, Router} from "@angular/router";
import {LocalStorageService} from "ngx-webstorage";

@Injectable()
export class RouteGuard implements CanActivate {

  constructor(private storage: LocalStorageService) {
  }

  canActivate() {
    return !this.storage.retrieve('jwt');
  }
}
