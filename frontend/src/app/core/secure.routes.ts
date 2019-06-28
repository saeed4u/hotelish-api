import {Routes} from "@angular/router";
import {HotelComponent} from "../hotel/hotel.component";
import {RoomTypeComponent} from "../roomtype/roomtype.component";

export const SECURE_ROUTES: Routes = [
  {path: '', component: HotelComponent},
  {path: 'hotel', component: HotelComponent},
  {path: 'room-type', component: RoomTypeComponent},
];
