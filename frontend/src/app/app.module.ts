import {BrowserModule} from "@angular/platform-browser";
import {NgModule} from "@angular/core";

import {AppRoutingModule} from "./core/app-routing.module";
import {AppComponent} from "./app.component";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";
import {LoginComponent} from "./login/login.component";
import {SharedModule} from "./core/shared.module";
import {FormsModule} from "@angular/forms";
import {ToolbarComponent} from "./shared/toolbar/toolbar.component";
import {ToastrModule} from "ng6-toastr-notifications";
import {NgxWebstorageModule} from "ngx-webstorage";
import {HTTP_INTERCEPTORS, HttpClientModule} from "@angular/common/http";
import {HttpConfigInterceptor} from "./core/interceptors/httpconfig.interceptor";
import {DEFAULT_TIMEOUT, TimeoutInterceptor} from "./core/interceptors/timeoutinterceptor.interceptor";
import {DashboardComponent} from "./dashboard/dashboard.component";
import {AuthGuard} from "./core/guards/auth.guard";
import {RouteGuard} from "./core/guards/route.guard";

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    ToolbarComponent,
    DashboardComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    SharedModule,
    FormsModule,
    ToastrModule.forRoot(),
    NgxWebstorageModule.forRoot(),
    HttpClientModule
  ],
  providers: [
    AuthGuard, RouteGuard,
    {provide: HTTP_INTERCEPTORS, useClass: HttpConfigInterceptor, multi: true},
    {provide: HTTP_INTERCEPTORS, useClass: TimeoutInterceptor, multi: true},
    {provide: DEFAULT_TIMEOUT, useValue: (15 * 1000)}
  ],
  bootstrap: [AppComponent]
})
export class AppModule {
}
