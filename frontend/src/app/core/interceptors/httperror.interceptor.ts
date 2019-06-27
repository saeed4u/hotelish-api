import {HttpErrorResponse, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from "@angular/common/http";
import {Observable, throwError} from "rxjs/index";
import {catchError} from "rxjs/internal/operators";
import {Injectable} from "@angular/core";
import {ErrorService} from "../../service/error.service";
import {IErrorMessage} from "../../model/IErrorMessage";
import {AuthStateService} from "../../service/authstate.service";


@Injectable()
export class HttpErrorInterceptor implements HttpInterceptor {


  constructor(private errorService: ErrorService, private authService: AuthStateService) {
  }

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    return next.handle(req).pipe(catchError((error: HttpErrorResponse) => {
      if (error.status >= 500) {
        const errorMessage: IErrorMessage = {
          title: 'We are sorry!', // todo a better default title
          errorMessage: 'An error occurred while communicating with our servers. Please try again.', // todo a better default error message
          errorDetail: error
        };
        this.errorService.setError(errorMessage);
      } else if (error.status === 401) {
        this.errorService.setError({
          title: 'Session Expired',
          errorMessage: 'Your session has expired, please login again',
          errorDetail: error
        });
        this.authService.setLoggedInState(false);
      } else {
        this.errorService.setError({
          title: 'Error',
          errorMessage: error.error ? error.error.message : 'An error occurred, please try again',
          errorDetail: error
        });
      }
      return throwError(error);
    }));
  }
}
