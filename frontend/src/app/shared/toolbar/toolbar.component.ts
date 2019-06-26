import { Component, OnInit } from '@angular/core';
import { AuthstateService } from 'src/app/service/authstate.service';

@Component({
  selector: 'app-toolbar',
  templateUrl: './toolbar.component.html',
  styleUrls: ['./toolbar.component.scss']
})
export class ToolbarComponent implements OnInit {
 loggedIn: boolean;
  constructor(private authState: AuthstateService) { }

  ngOnInit() {
    this.authState.authState.subscribe({
      next: (value:boolean) => {
          this.loggedIn = value;
      },
      error: error => {
        console.log(error);
      }

    });
  }

}
