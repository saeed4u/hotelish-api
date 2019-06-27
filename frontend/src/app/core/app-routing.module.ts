import {NgModule} from "@angular/core";
import {RouterModule, Routes} from "@angular/router";
import {LoginComponent} from "../login/login.component";
import {DashboardComponent} from "../dashboard/dashboard.component";
import {AuthGuard} from "./guards/auth.guard";
import {RouteGuard} from "./guards/route.guard";

const routes: Routes = [
  {path: 'login', component: LoginComponent, canActivate: [RouteGuard]},
  {path: '', component: DashboardComponent, canActivate: [AuthGuard]}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
