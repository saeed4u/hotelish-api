import {Component, Inject, OnInit} from "@angular/core";
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material";

@Component({
  selector: 'app-roomtypedialog',
  templateUrl: './genericdialog.component.html',
  styleUrls: ['./genericdialog.component.scss']
})
export class GenericDialogComponent implements OnInit {


  constructor(public dialogRef: MatDialogRef<GenericDialogComponent>,
              @Inject(MAT_DIALOG_DATA) public data: object) {
  }

  ngOnInit() {
  }

  cancel() {
    this.dialogRef.close();
  }
}
