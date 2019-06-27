import {Component, OnDestroy, OnInit} from "@angular/core";
import {ErrorService} from "./service/error.service";
import {NotificationService} from "./service/notification.service";
import {IErrorMessage} from "./model/IErrorMessage";
import {Subscription} from "rxjs/index";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit, OnDestroy {

  subscription: Subscription

  constructor(private errorService: ErrorService, private notificationService: NotificationService) {

  }

  ngOnInit() {
    this.subscription = this.errorService.listeners.subscribe({
      next: (err: IErrorMessage) => {
        this.notificationService.generalError(err);
      }
    });
  }

  ngOnDestroy() {
    if (this.subscription) {
      this.subscription.unsubscribe();
    }
  }

}
