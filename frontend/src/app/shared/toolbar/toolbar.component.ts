import {Component, OnInit} from "@angular/core";
import {AuthStateService} from "src/app/service/authstate.service";
import {Router} from "@angular/router";
import {MatDialog} from "@angular/material";

@Component({
  selector: 'app-toolbar',
  templateUrl: './toolbar.component.html',
  styleUrls: ['./toolbar.component.scss']
})
export class ToolbarComponent implements OnInit {
  loggedIn: boolean;

  constructor(private router: Router, private authState: AuthStateService, private dialog: MatDialog) {
  }

  ngOnInit() {
    this.authState.authState.subscribe({
      next: (value: boolean) => {
        this.loggedIn = value;
        if(!this.loggedIn){

          this.dialog.closeAll()
          this.router.navigate(['/login']);
        }
      },
      error: error => {
        console.log(error);
      }

    });
  }

  navigateTo(url: string) {
    this.router.navigate([url]);
  }

  logout() {
    this.authState.setLoggedInState(false);
    this.router.navigate(['/login']);
  }

}
