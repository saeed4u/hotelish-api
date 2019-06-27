import { Component, OnInit } from '@angular/core';
import {DashboardRepo} from "../core/repo/dashboard.repo";

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  constructor(private dashboardRepo: DashboardRepo) { }

  ngOnInit() {
  }

}
