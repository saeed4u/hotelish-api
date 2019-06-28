import {Routes} from "@angular/router";
import {HotelComponent} from "../hotel/hotel.component";
import {RoomTypeComponent} from "../roomtypes/roomtypes.component";
import {RoomsComponent} from "../rooms/rooms.component";

export const SECURE_ROUTES: Routes = [
  {path: '', component: HotelComponent},
  {path: 'hotel', component: HotelComponent},
  {path: 'rooms', component: RoomsComponent},
  {path: 'room-types', component: RoomTypeComponent},
];
