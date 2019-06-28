import {NgModule} from "@angular/core";
import {CommonModule} from "@angular/common";
import {
  MatButtonModule,
  MatCardModule,
  MatDialogModule,
  MatDividerModule,
  MatExpansionModule,
  MatFormFieldModule,
  MatIconModule,
  MatInputModule,
  MatListModule,
  MatMenuModule,
  MatProgressBarModule,
  MatSidenavModule,
  MatTableModule,
  MatToolbarModule,
  MatTooltipModule,
  MatGridListModule,
} from "@angular/material";
import {FlexLayoutModule} from "@angular/flex-layout";
import {AuthStateService} from "../service/authstate.service";
import {NotificationService} from "../service/notification.service";
import {ErrorService} from "../service/error.service";
import {HotelRepo} from "./repo/hotel.repo";
import {FileUploadModule} from "ng2-file-upload/ng2-file-upload";
import {RoomTypeRepo} from "./repo/roomtype.repo";

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
  ],
  providers: [
    AuthStateService,
    NotificationService,
    ErrorService,
    HotelRepo,
    RoomTypeRepo,
  ]
})
export class SharedModule {

}
