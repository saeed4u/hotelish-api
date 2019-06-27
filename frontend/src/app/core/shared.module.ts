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
  MatTooltipModule
} from "@angular/material";
import {FlexLayoutModule} from "@angular/flex-layout";
import {AuthStateService} from "../service/authstate.service";
import {NotificationService} from "../service/notification.service";
import {ErrorService} from "../service/error.service";
import {HotelRepo} from "./repo/hotel.repo";
import { FileUploadModule } from "ng2-file-upload/ng2-file-upload";
import {ImageUploadComponent} from "../imageupload/imageupload.component";

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
    FlexLayoutModule
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
    FlexLayoutModule
  ],
  providers: [
    AuthStateService,
    NotificationService,
    ErrorService,
    HotelRepo,
  ]
})
export class SharedModule {

}
