import {Injectable} from "@angular/core";

import {ToastrManager} from "ng6-toastr-notifications";

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

  private success(message: string) {
    this.toaster.successToastr(message);
  }

  private error(message: string) {
    this.toaster.errorToastr(message);
  }
}
