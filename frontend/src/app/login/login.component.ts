import {Component, OnInit} from "@angular/core";
import {AuthStateService} from "../service/authstate.service";
import {NotificationService} from "../service/notification.service";
import {ApiService} from "../service/api.service";
import {LoginResponse} from "../model/Responses";
import {LocalStorageService} from "ngx-webstorage";
import {Router} from "@angular/router";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  email: string;
  password: string;
  loggingIn: boolean;

  constructor(private authState: AuthStateService,
              private notificationService: NotificationService,
              private apiService: ApiService,
              private localStorage: LocalStorageService, private router: Router) {
  }

  ngOnInit() {
    this.loggingIn = false;
  }

  isEmailValid() {
    const EMAIL_REGEXP = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$/i;
    return EMAIL_REGEXP.test(this.email);
  }

  public login() {
    if (!this.isEmailValid()) {
      this.notificationService.info('Please enter a valid email address');
      return;
    } else if (!this.password || this.password.length < 6) {
      this.notificationService.info('Please enter your password');
      return;
    }
    this.loggingIn = true;
    const authPayload = {
      email: this.email,
      password: this.password
    };
    this.apiService.login(authPayload).subscribe({
      next: (res: LoginResponse) => {
        this.authState.setLoggedInState(true);
        this.localStorage.store('jwt', res.user.token);
        this.localStorage.store('user', res.user);
        this.notificationService.loginSuccess();
        this.router.navigateByUrl('/').then();
      },
      error: () => {
        this.loggingIn = false;
        this.notificationService.loginError();
      }
    });
  }


}
