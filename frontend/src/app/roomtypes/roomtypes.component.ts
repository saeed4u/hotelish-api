import {Component, OnInit} from "@angular/core";
import {RoomTypeRepo} from "../core/repo/roomtype.repo";
import {RoomType} from "../model/Responses";
import {MatDialog, MatTableDataSource} from "@angular/material";
import {GenericDialogComponent} from "../dialog/genericdialog/genericdialog.component";
import {DeleteConfirmationDialogComponent} from "../dialog/delete-confirmation-dialog/delete-confirmation-dialog.component";

@Component({
  selector: 'app-roomtype',
  templateUrl: './roomtypes.component.html',
  styleUrls: ['./roomtypes.component.scss']
})
export class RoomTypeComponent implements OnInit {

  loading: boolean;
  roomTypes = new MatTableDataSource<RoomType>();


  displayedColumns: string[] = ['id', 'name', 'actions'];


  constructor(private roomTypeRepo: RoomTypeRepo, private dialog: MatDialog) {
  }

  ngOnInit() {
    this.loading = true;

    this.roomTypeRepo.getRoomTypes()
      .subscribe({
        next: (roomTypes: Array<RoomType>) => {
          this.roomTypes.data = roomTypes;
          this.loading = false;
        },
        error: err => {
          this.loading = false;
          console.log(err);
        }
      });
  }

  addNewRoomType() {
    const roomType = {
      name: ''
    };
    this.openDialog({
      title: 'Add a room type', roomType: roomType,
      type: 'room-type'
    }, (data: RoomType) => {
      this.loading = true;
      this.roomTypeRepo.addRoomType(data)
        .subscribe({
          next: (roomTypes: RoomType[]) => {
            this.loading = false;
            this.roomTypes.data = roomTypes;
            console.log(this.roomTypes);
          },
          error: err => {
            this.loading = false;
            console.log(err);
          }
        });
    });
  }

  edit(roomType: RoomType) {
    this.openDialog({
      title: `Edit \'${roomType.name}\'`, roomType: roomType,
      type: 'room-type'
    }, (data: RoomType) => {
      this.loading = true;
      this.roomTypeRepo.updateRoomType(data)
        .subscribe({
          next: (roomTypes: RoomType[]) => {
            this.loading = false;
            this.roomTypes.data = roomTypes;
            console.log(this.roomTypes);
          },
          error: err => {
            this.loading = false;
            console.log(err);
          }
        });
    });
  }

  deleteRoomType(roomType: RoomType) {
    this.openDeleteDialog(roomType);
  }

  private openDeleteDialog(roomType: RoomType) {
    const dialogRef = this.dialog.open(DeleteConfirmationDialogComponent, {
      width: '350px',
      data: {
        message: `Are you sure you want to delete \'${roomType.name}\'?`,
        result: true
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.loading = true;
        this.roomTypeRepo.deleteRoomType(roomType)
          .subscribe({
            next: (roomTypes: RoomType[]) => {
              this.loading = false;
              this.roomTypes.data = roomTypes;
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
