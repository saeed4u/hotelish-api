import {Routes} from "@angular/router";
import {HotelComponent} from "../hotel/hotel.component";
import {RoomTypeComponent} from "../roomtypes/roomtypes.component";
import {RoomsComponent} from "../rooms/rooms.component";
import {PricingComponent} from "../pricing/pricing.component";
import {BookingComponent} from "../booking/booking.component";

export const SECURE_ROUTES: Routes = [
  {path: '', component: BookingComponent},
  {path: 'hotel', component: HotelComponent},
  {path: 'rooms', component: RoomsComponent},
  {path: 'room-types', component: RoomTypeComponent},
  {path: 'pricings', component: PricingComponent},
  {path: 'bookings', component: BookingComponent},
];
