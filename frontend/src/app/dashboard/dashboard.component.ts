import { Component, OnInit } from '@angular/core';
import {HotelRepo} from "../core/repo/hotel.repo";

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  constructor(private dashboardRepo: HotelRepo) { }

  ngOnInit() {
  }

}
