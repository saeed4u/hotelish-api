import {Injectable} from "@angular/core";
import {HttpHandler, HttpInterceptor, HttpRequest} from "@angular/common/http";
import {LocalStorageService} from "ngx-webstorage";

// 15 minutes
const DEFAULT_JWT_EXPIRE = 15 * 60 * 1000;

@Injectable()
export class HttpConfigInterceptor implements HttpInterceptor {
  constructor(private storage: LocalStorageService) {
  }


  intercept(req: HttpRequest<any>, next: HttpHandler) {
    const jwt = this.storage.retrieve('jwt');
    const url = req.url;
    if (!url.includes('image') && !req.headers.has('content-Type')) {
      req = req.clone({headers: req.headers.set('Content-Type', 'application/json')});
    }
    if (jwt) {
      req = req.clone({headers: req.headers.set('Authorization', `Bearer ${jwt}`)});
    }
    req = req.clone({headers: req.headers.set('Accept', 'application/json')});
    return next.handle(req);

  }


}
