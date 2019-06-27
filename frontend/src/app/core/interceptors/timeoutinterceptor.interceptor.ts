import {HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from "@angular/common/http";
import {Observable} from "rxjs/index";
import {Inject, Injectable, InjectionToken} from "@angular/core";
import {timeout} from "rxjs/operators";

export const DEFAULT_TIMEOUT = new InjectionToken<number>('defaultTimeout');

@Injectable()
export class TimeoutInterceptor implements HttpInterceptor {

  constructor(@Inject(DEFAULT_TIMEOUT) private defaultTimeout: number) {

  }

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    return next.handle(req).pipe(timeout(Number(this.defaultTimeout)));
  }

}

