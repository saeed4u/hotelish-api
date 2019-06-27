import {Injectable} from "@angular/core";
import {Subject} from "rxjs/index";
import {IErrorMessage} from "../model/IErrorMessage";
@Injectable()
export class ErrorService {
  public listeners = new Subject<IErrorMessage>();

  setError(error: IErrorMessage) {
    this.listeners.next(error);
  }

}
