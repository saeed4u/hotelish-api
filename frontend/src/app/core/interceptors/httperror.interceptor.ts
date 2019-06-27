import {HttpErrorResponse, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from '@angular/common/http';
import {Observable, throwError} from 'rxjs/index';
import {catchError} from 'rxjs/internal/operators';
import {Injectable} from '@angular/core';
import {ErrorService} from "../../service/error.service";
import {IErrorMessage} from "../../model/IErrorMessage";


@Injectable()
export class HttpErrorInterceptor implements HttpInterceptor {



  constructor(private errorService: ErrorService) {
  }

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    return next.handle(req).pipe(catchError((error: HttpErrorResponse) => {
      console.log(error);
      if(error.status >= 500) {
        const errorMessage: IErrorMessage = {
          title: 'We are sorry!', // todo a better default title
          errorMessage: 'An error occurred while communicating with our servers. Please try again.', // todo a better default error message
          errorDetail: error
        };
        this.errorService.setError(errorMessage);
      }
      return throwError(error);
    }));
  }
}
