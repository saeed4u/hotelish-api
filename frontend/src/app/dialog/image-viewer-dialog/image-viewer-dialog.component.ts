import {Component, Inject, OnInit} from "@angular/core";
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material";
import {GenericDialogComponent} from "../genericdialog/genericdialog.component";
import {ImageViewer} from "../../model/ImageViewer";

@Component({
  selector: 'app-image-viewer-dialog',
  templateUrl: './image-viewer-dialog.component.html',
  styleUrls: ['./image-viewer-dialog.component.scss']
})
export class ImageViewerDialogComponent implements OnInit {


  constructor(public dialogRef: MatDialogRef<GenericDialogComponent>,
              @Inject(MAT_DIALOG_DATA) public data: ImageViewer) {
  }

  ngOnInit() {
  }

  cancel() {
    this.dialogRef.close();
  }

}
