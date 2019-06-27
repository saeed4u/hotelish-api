import {Injectable} from '@angular/core';

import {ToastrManager} from 'ng6-toastr-notifications';
import {IErrorMessage} from '../model/IErrorMessage';

@Injectable({
  providedIn: 'root'
})
export class NotificationService {

  constructor(private toaster: ToastrManager) {
  }

  loginError() {
    this.error('Opps! We did not recognised the given credentials, please try again.');
  }

  loginSuccess() {
    this.success('Great to have you here!');
  }

  info(message: string) {
    this.toaster.warningToastr(message);
  }


  success(message: string) {
    this.toaster.successToastr(message);
  }

  error(message: string) {
    this.toaster.errorToastr(message);
  }

  generalError(error: IErrorMessage) {
    this.toaster.errorToastr(error.errorMessage, error.title);
  }
}
