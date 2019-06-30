import {Component, OnInit} from "@angular/core";
import {HotelRepo} from "../core/repos/hotel.repo";
import {FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {Hotel} from "../model/Responses";
import {isEqual} from "lodash";
import {NotificationService} from "../service/notification.service";
import {MatDialog} from "@angular/material";
import {ImageUploadComponent} from "../dialog/imageupload/imageupload.component";
import {ImageUpload} from "../model/ImageUpload";

@Component({
  selector: 'app-hotel',
  templateUrl: './hotel.component.html',
  styleUrls: ['./hotel.component.scss']
})
export class HotelComponent implements OnInit {

  loading: boolean;
  hotelInfo: FormGroup;
  hotel: object;
  hotelImmutable: Hotel;
  changes: boolean;
  private errorMessages = {
    name: 'Hotel\'s name is required',
    address: 'Hotel\'s address is required',
    city: 'Hotel\'s city is required',
    state: 'Hotel\'s state is required'
  };

  constructor(private repo: HotelRepo, private formBuilder: FormBuilder, private notificationService: NotificationService,
              private dialog: MatDialog) {
  }

  ngOnInit() {
    this.loading = true;
    this.getHotelInfo();
  }

  private getHotelInfo() {
    this.repo.getHotel()
      .subscribe({
        next: (hotel: Hotel) => {
          this.loading = false;
          this.hotelImmutable = hotel;
          this.hotel = {
            name: hotel.name,
            email: hotel.email,
            address: hotel.address,
            state: hotel.state,
            city: hotel.city,
            zip_code: hotel.zip_code,
          };
          this.createHotelForm();
        },
        error: () => {
          this.loading = false;
        },
      });
  }

  openUploadDialog() {
    const data: ImageUpload = {
      url: '/hotel/image',
      callback: (wasSuccessful) => {
        if (wasSuccessful) {
          this.repo.refreshData();
          this.getHotelInfo();
        }
      }
    };
    this.dialog.open(ImageUploadComponent, {width: '70%', height: '50%', data: data});
  }

  updateHotel() {
    this.loading = true;
    this.repo.updateHotel(this.hotelInfo.value)
      .subscribe({
        next: (hotel: Hotel) => {
          this.notificationService.success('Hotel updated successfully');
          this.hotel = {
            name: hotel.name,
            email: hotel.email,
            address: hotel.address,
            state: hotel.state,
            city: hotel.city,
            zip_code: hotel.zip_code
          };
          this.loading = false;
        },
        error: () => {
          this.loading = false;
        },
      });
  }

  private createHotelForm() {
    const EMAIL_REGEXP = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$/i;
    this.hotelInfo = this.formBuilder.group({
      name: new FormControl(this.hotelImmutable.name, Validators.required),
      email: new FormControl(this.hotelImmutable.email, [Validators.required, Validators.pattern(EMAIL_REGEXP)]),
      address: new FormControl(this.hotelImmutable.address, Validators.required),
      city: new FormControl(this.hotelImmutable.city, Validators.required),
      state: new FormControl(this.hotelImmutable.state, Validators.required),
      zip_code: new FormControl(this.hotelImmutable.zip_code, Validators.required),
      country: new FormControl({value: this.hotelImmutable.country.name, disabled: true}),
    });
    this.listenForChanges();
  }

  private listenForChanges() {
    this.hotelInfo.valueChanges.subscribe({
      next: change => {
        this.changes = !isEqual(this.hotel, change);
      }
    });
  }

  getError(formName) {
    switch (formName) {
      case 'email':
        return this.getEmailError();
      default:
        return this.errorMessages[formName];
    }
  }

  get name() {
    return this.hotelInfo.get('name') as FormControl;
  }

  private getEmailError() {
    const emailInput = this.hotelInfo.get('email');
    if (emailInput.hasError('required')) {
      return 'Hotel email is required';
    } else if (emailInput.hasError('pattern')) {
      return 'Please enter a valid email';
    }
  }


}
