import {NgModule} from "@angular/core";
import {CommonModule} from "@angular/common";
import {
  MatButtonModule,
  MatCardModule,
  MatDatepickerModule,
  MatDialogModule,
  MatDividerModule,
  MatExpansionModule,
  MatFormFieldModule,
  MatGridListModule,
  MatIconModule,
  MatInputModule,
  MatListModule,
  MatMenuModule,
  MatProgressBarModule,
  MatSelectModule,
  MatSidenavModule,
  MatTableModule,
  MatToolbarModule,
  MatTooltipModule
} from "@angular/material";
import {FlexLayoutModule} from "@angular/flex-layout";
import {AuthStateService} from "../service/authstate.service";
import {NotificationService} from "../service/notification.service";
import {ErrorService} from "../service/error.service";
import {HotelRepo} from "./repos/hotel.repo";
import {FileUploadModule} from "ng2-file-upload/ng2-file-upload";
import {RoomTypeRepo} from "./repos/roomtype.repo";
import {RoomRepo} from "./repos/room.repo";
import {PricingRepo} from "./repos/pricing.repo";
import {MatMomentDateModule} from "@angular/material-moment-adapter";
import {BookingRepo} from "./repos/booking.repo";

@NgModule({
  imports: [
    CommonModule,
    MatToolbarModule,
    MatButtonModule,
    MatCardModule,
    MatInputModule,
    MatDialogModule,
    MatTableModule,
    MatMenuModule,
    MatIconModule,
    MatProgressBarModule,
    MatDividerModule,
    MatListModule,
    MatSidenavModule,
    MatTooltipModule,
    MatExpansionModule,
    FileUploadModule,
    FlexLayoutModule,
    MatGridListModule,
    MatSelectModule,
    MatDatepickerModule,
    MatMomentDateModule
  ],
  exports: [
    CommonModule,
    MatToolbarModule,
    MatButtonModule,
    MatCardModule,
    MatInputModule,
    MatDialogModule,
    MatTableModule,
    MatMenuModule,
    MatIconModule,
    MatProgressBarModule,
    MatFormFieldModule,
    MatDividerModule,
    MatListModule,
    MatSidenavModule,
    MatTooltipModule,
    FileUploadModule,
    MatExpansionModule,
    FlexLayoutModule,
    MatGridListModule,
    MatSelectModule,
    MatDatepickerModule,
    MatMomentDateModule
  ],
  providers: [
    AuthStateService,
    NotificationService,
    ErrorService,
    HotelRepo,
    RoomTypeRepo,
    RoomRepo,
    PricingRepo,
    BookingRepo,
  ]
})
export class SharedModule {

}
