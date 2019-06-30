import {Component, OnInit, ViewEncapsulation} from "@angular/core";
import * as moment from "moment";
import {Moment} from "moment";
import {MatDialog, MatTableDataSource} from "@angular/material";
import {BookingRepo} from "../core/repos/booking.repo";
import {RoomRepo} from "../core/repos/room.repo";
import {Booking, Room} from "../model/Responses";
import {zip} from "rxjs/index";
import {GenericDialogComponent} from "../dialog/genericdialog/genericdialog.component";
import {DeleteConfirmationDialogComponent} from "../dialog/delete-confirmation-dialog/delete-confirmation-dialog.component";
import {FormControl} from "@angular/forms";
import _date = moment.unitOfTime._date;

@Component({
  selector: 'app-booking',
  templateUrl: './booking.component.html',
  styleUrls: ['./booking.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class BookingComponent implements OnInit {

  loading: boolean;
  bookings = new MatTableDataSource<Booking>();
  displayedColumns: string[] = ['id', 'customer name', 'customer email', 'start date', 'end date', 'room', 'total nights', 'total price', 'actions'];

  rooms: Room[];

  dateClass: any;


  date: FormControl;


  constructor(private bookingRepo: BookingRepo, private roomRepo: RoomRepo, private dialog: MatDialog) {
  }

  ngOnInit() {
    this.date = new FormControl({
      value: null,
      disabled: true
    });
    this.loading = true;
    zip(this.getBookings(), this.roomRepo.getRooms())
      .subscribe({
        next: (results: [Booking[], Room[]]) => {
          this.loading = false;
          this.bookings.data = results[0];
          this.rooms = results[1];
          this.dateClass = (d: Moment) => {
            const date = d.dayOfYear();
            const [bookedDate] = results[0].filter((booking: Booking) => {
              return moment(booking.start_date).dayOfYear() === date;
            });
            if (bookedDate) {
              return 'booked-date';
            }
          };

        }
      });
  }

  private getBookings() {
    return this.bookingRepo.getBookings();
  }


  chosenDateHandler() {
    const date: Moment = this.date.value;
    this.applyFilter(date.format("YYYY-MM-DD"));
  }

  applyFilter(selectedDate: string) {
    this.bookings.filter = selectedDate;
  }

  addNewBooking() {
    const booking = {
      name: '',
      email: '',
      start_date: moment(),
      end_date: moment().add(1, 'days'),
      rooms: this.rooms,
      room_id: -1,
    };
    this.openDialog({
      type: 'booking',
      title: 'Add a booking',
      booking: booking
    }, (data: Booking) => {
      delete data['rooms'];
      this.loading = true;
      console.log('here');
      this.bookingRepo.addBooking(data)
        .subscribe({
          next: (bookings: Booking[]) => {
            this.loading = false;
            this.bookings.data = bookings;
            console.log(this.bookings);
          },
          error: err => {
            this.loading = false;
            console.log(err);
          }
        });
    });
  }

  editBooking(booking: Booking) {
    const data = {
      id: booking.id,
      name: booking.customer_name,
      email: booking.customer_email,
      start_date: booking.start_date,
      end_date: booking.end_date,
      rooms: this.rooms,
      room_id: booking.room.id,
    };
    this.openDialog({
      type: 'booking',
      title: `Edit booking`,
      booking: data
    }, (updatedBooking) => {
      delete data['rooms'];
      this.loading = true;
      this.bookingRepo.updateBooking(updatedBooking)
        .subscribe({
          next: (bookings: Booking[]) => {
            this.loading = false;
            this.bookings.data = bookings;
          },
          error: err => {
            this.loading = false;
            console.log(err);
          }
        });
    });
  }

  private openDialog(data: object, callback): void {
    const dialogRef = this.dialog.open(GenericDialogComponent, {
      width: '450px',
      data: data
    });

    dialogRef.afterClosed().subscribe(result => {
      console.log(result);
      if (result && callback) {
        callback(result);
      }
    });
  }

  deleteBooking(booking: Booking) {
    this.openDeleteDialog(booking);
  }

  private openDeleteDialog(booking: Booking) {
    const dialogRef = this.dialog.open(DeleteConfirmationDialogComponent, {
      width: '350px',
      data: {
        message: `Are you sure you want to delete this booking?`,
        result: true
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.loading = true;
        this.bookingRepo.deleteBooking(booking)
          .subscribe({
            next: (bookings: Booking[]) => {
              this.loading = false;
              this.bookings.data = bookings;
            },
            error: () => {
              this.loading = false;
            }
          });
      }
    });
  }


}
