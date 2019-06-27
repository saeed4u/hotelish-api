import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {
  MatButtonModule,
  MatCardModule,
  MatDialogModule,
  MatFormFieldModule,
  MatIconModule,
  MatInputModule,
  MatMenuModule,
  MatTableModule,
  MatToolbarModule,
  MatProgressBarModule
} from '@angular/material';
import {FlexLayoutModule} from '@angular/flex-layout';
import {AuthstateService} from '../service/authstate.service';
import {NotificationService} from '../service/notification.service';
import {DEFAULT_TIMEOUT, TimeoutInterceptor} from "./interceptors/timeoutinterceptor.interceptor";
import {HttpErrorInterceptor} from "./interceptors/httperror.interceptor";
import {HTTP_INTERCEPTORS} from "@angular/common/http";
import {HttpConfigInterceptor} from "./interceptors/httpconfig.interceptor";
import {ErrorService} from "../service/error.service";
import {DashboardRepo} from "./repo/dashboard.repo";

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
    FlexLayoutModule
  ],
  providers: [
    AuthstateService,
    NotificationService,
    ErrorService,
    DashboardRepo
  ]
})
export class SharedModule {

}
