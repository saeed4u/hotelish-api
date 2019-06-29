import {Component, OnInit} from "@angular/core";
import {Room, RoomType} from "../model/Responses";
import {MatDialog, MatTableDataSource} from "@angular/material";
import {RoomRepo} from "../core/repo/room.repo";
import {RoomTypeRepo} from "../core/repo/roomtype.repo";
import {zip} from "rxjs/index";
import {GenericDialogComponent} from "../dialog/genericdialog/genericdialog.component";
import {DeleteConfirmationDialogComponent} from "../dialog/delete-confirmation-dialog/delete-confirmation-dialog.component";
import {ImageViewer} from "../model/ImageViewer";
import {ImageViewerDialogComponent} from "../dialog/image-viewer-dialog/image-viewer-dialog.component";
import {ImageUploadComponent} from "../dialog/imageupload/imageupload.component";

@Component({
  selector: 'app-room',
  templateUrl: './rooms.component.html',
  styleUrls: ['./rooms.component.scss']
})
export class RoomsComponent implements OnInit {

  loading: boolean;
  rooms = new MatTableDataSource<Room>();
  roomTypes: RoomType[];

  displayedColumns: string[] = ['id', 'name', 'room type', 'view images', 'actions'];


  constructor(private roomRepo: RoomRepo, private roomTypeRepo: RoomTypeRepo, private dialog: MatDialog) {
  }

  ngOnInit() {
    this.loading = true;
    zip(this.roomRepo.getRooms(), this.roomTypeRepo.getRoomTypes()).subscribe({
      next: (results: [Room[], RoomType[]]) => {
        this.rooms.data = results[0];
        this.roomTypes = results[1];
        this.loading = false;
      },
      error: err => {
        this.loading = false;
        console.log(err);
      }
    });

  }

  viewImages(room: Room) {
    const data: ImageViewer = {
      images: room.images,
      title: `${room.name}\'s Images`,
      addCallback: () => {
        this.dialog.open(ImageUploadComponent, {
          width: '70%', height: '50%', data: {
            url: `/room/${room.id}/image`,
            callback: () => {
              this.roomRepo.refreshData();
              this.roomRepo.getRooms();
            }
          }
        });
      }
    };
    this.dialog.open(ImageViewerDialogComponent, {
      width: '70%', height: '50%',
      data: data
    });

  }

  addNewRoom() {
    const room = {
      name: '',
      roomTypes: this.roomTypes,
      room_type_id: -1
    };
    this.openDialog({
      type: 'room',
      title: 'Add a room',
      room: room
    }, (data: Room) => {
      delete data['roomTypes'];
      this.loading = true;
      this.roomRepo.addRoom(data)
        .subscribe({
          next: (rooms: Room[]) => {
            this.loading = false;
            this.rooms.data = rooms;
            console.log(this.rooms);
          },
          error: err => {
            this.loading = false;
            console.log(err);
          }
        });
    });
  }

  editRoom(room: Room) {
    const data = {
      id: room.id,
      name: room.name,
      roomTypes: this.roomTypes,
      room_type_id: room.type.id
    };
    this.openDialog({
      type: 'room',
      title: `Edit \'${room.name}\'`,
      room: data
    }, (updatedRoom) => {
      delete data['roomTypes'];
      if (updatedRoom.name === room.name && updatedRoom.room_type_id === room.type.id) {
        return;
      }
      this.loading = true;
      this.roomRepo.updateRoom(updatedRoom)
        .subscribe({
          next: (rooms: Room[]) => {
            this.loading = false;
            this.rooms.data = rooms;
            console.log(this.rooms);
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
      if (result && callback) {
        callback(result);
      }
    });
  }

  deleteRoom(room: Room) {
    this.openDeleteDialog(room);
  }

  private openDeleteDialog(room: Room) {
    const dialogRef = this.dialog.open(DeleteConfirmationDialogComponent, {
      width: '350px',
      data: {
        message: `Are you sure you want to delete \'${room.name}\'?`,
        result: true
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.loading = true;
        this.roomRepo.deleteRoom(room)
          .subscribe({
            next: (rooms: Room[]) => {
              this.loading = false;
              this.rooms.data = rooms;
            },
            error: () => {
              this.loading = false;
            }
          });
      }
    });
  }
}
