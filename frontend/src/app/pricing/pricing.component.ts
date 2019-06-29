import {Component, OnInit} from "@angular/core";
import {PricingRepo} from "../core/repo/pricing.repo";
import {MatDialog, MatTableDataSource} from "@angular/material";
import {Pricing, RoomType} from "../model/Responses";
import {RoomTypeRepo} from "../core/repo/roomtype.repo";
import {zip} from "rxjs/index";
import {DeleteConfirmationDialogComponent} from "../dialog/delete-confirmation-dialog/delete-confirmation-dialog.component";
import {GenericDialogComponent} from "../dialog/genericdialog/genericdialog.component";

@Component({
  selector: 'app-pricing',
  templateUrl: './pricing.component.html',
  styleUrls: ['./pricing.component.scss']
})
export class PricingComponent implements OnInit {
  loading: boolean;
  pricings = new MatTableDataSource<Pricing>();
  roomTypes: RoomType[];


  displayedColumns: string[] = ['id', 'room type', 'price', 'actions'];


  constructor(private pricingRepo: PricingRepo, private roomTypeRepo: RoomTypeRepo, private dialog: MatDialog) {
  }

  ngOnInit() {
    this.loading = true;

    zip(this.pricingRepo.getPricings(), this.roomTypeRepo.getRoomTypes())
      .subscribe({
        next: (results: [Pricing[], RoomType[]]) => {
          this.pricings.data = results[0];
          this.roomTypes = results[1];
          this.loading = false;
        },
        error: err => {
          this.loading = false;
          console.log(err);
        }
      });
  }

  addPricing() {
    const pricing = {
      price: '',
      roomTypes: this.roomTypes,
      room_type_id: -1,
    };
    this.openDialog({
      title: 'Add a pricing',
      pricing: pricing,
      type: 'pricing'
    }, (data: Pricing) => {
      this.loading = true;
      delete data['roomTypes';]
      this.pricingRepo.addPricing(data)
        .subscribe({
          next: (pricings: Pricing[]) => {
            this.loading = false;
            this.pricings.data = pricings;
            console.log(this.pricings);
          },
          error: err => {
            this.loading = false;
            console.log(err);
          }
        });
    });
  }

  edit(pricing: Pricing) {

    const data = {
      id: pricing.id,
      price: pricing.price,
      roomTypes: this.roomTypes,
      room_type_id: pricing.room_type.id
    };

    this.openDialog({
      title: `Edit pricing of ${pricing.room_type.name}`,
      pricing: data,
      type: 'pricing'
    }, (upatedPricing: Pricing) => {
      this.loading = true;
      delete upatedPricing['roomTypes'];
      this.pricingRepo.updatePricing(data)
        .subscribe({
          next: (pricings: Pricing[]) => {
            this.loading = false;
            this.pricings.data = pricings;
            console.log(this.pricings);
          },
          error: err => {
            this.loading = false;
            console.log(err);
          }
        });
    });
  }

  deletePricing(pricing: Pricing) {
    this.openDeleteDialog(pricing);
  }

  private openDeleteDialog(pricing: Pricing) {
    const dialogRef = this.dialog.open(DeleteConfirmationDialogComponent, {
      width: '450px',
      data: {
        message: `Are you sure you want to delete pricing of \'${pricing.room_type.name}\'?`,
        result: true
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.loading = true;
        this.pricingRepo.deletePricing(pricing)
          .subscribe({
            next: (pricings: Pricing[]) => {
              this.loading = false;
              this.pricings.data = pricings;
            },
            error: () => {
              this.loading = false;
            }
          });
      }
    });
  }

  private openDialog(data: object, callback): void {
    const dialogRef = this.dialog.open(GenericDialogComponent, {
      width: '350px',
      data: data
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result && callback) {
        callback(result);
      }
    });
  }


}
