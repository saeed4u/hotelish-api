import {Component, OnInit} from "@angular/core";
import {AuthstateService} from "../service/authstate.service";
import {NotificationService} from "../service/notification.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  email: string;
  password: string;
  loggingIn: boolean;

  constructor(private authState: AuthstateService, private notificationService: NotificationService) {
  }

  ngOnInit() {
    this.loggingIn = false;
  }

  login(){
    this.loggingIn = true;
  }

}
