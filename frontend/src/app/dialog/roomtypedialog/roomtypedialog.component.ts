import {Component, Inject, OnInit} from "@angular/core";
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material";
import {RoomType} from "../../model/Responses";

@Component({
  selector: 'app-roomtypedialog',
  templateUrl: './roomtypedialog.component.html',
  styleUrls: ['./roomtypedialog.component.scss']
})
export class RoomTypeDialogComponent implements OnInit {


  constructor(public dialogRef: MatDialogRef<RoomTypeDialogComponent>,
              @Inject(MAT_DIALOG_DATA) public data: RoomType) {
  }

  ngOnInit() {
  }

  cancel() {
    this.dialogRef.close();
  }
}
