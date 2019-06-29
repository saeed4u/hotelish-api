import {Component, Inject, OnInit, ViewChild} from "@angular/core";
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material";
import {ImageUploadService} from "../../service/imageupload.service";
import {forkJoin} from "rxjs/index";
import {FileUploadResult} from "../../model/ImageUploadResult";
import {ImageUpload} from "../../model/ImageUpload";

@Component({
  selector: 'app-imageupload',
  templateUrl: './imageupload.component.html',
  styleUrls: ['./imageupload.component.scss']
})
export class ImageUploadComponent implements OnInit {

  @ViewChild('file') file;

  progress: FileUploadResult;
  canBeClosed: boolean;
  primaryButtonText: string;
  showCancelButton: boolean;
  uploading: boolean;
  uploadSuccessful: boolean;

  public files: Set<File> = new Set();

  constructor(private dialogRef: MatDialogRef<ImageUploadComponent>, @Inject(MAT_DIALOG_DATA) public data: ImageUpload, private imageUploadService: ImageUploadService) {
  }

  ngOnInit() {
    this.canBeClosed = true;
    this.primaryButtonText = 'Upload';
    this.showCancelButton = true;
    this.uploading = false;
    this.uploadSuccessful = false;
    this.dialogRef.beforeClosed().subscribe(() => {
      this.data.callback(this.uploadSuccessful);
    });
  }

  onFilesAdded() {
    const files: { [key: string]: File } = this.file.nativeElement.files;
    for (const key in files) {
      if (!isNaN(parseInt(key))) {
        this.files.add(files[key]);
      }
    }
    if (this.files.size > 0 && !this.canBeClosed) {
      // this.canBeClosed = true;
    }
  }

  uploadFiles() {
    if (this.uploadSuccessful) {
      this.dialogRef.close();
      return;
    }

    this.uploading = true;

    this.progress = this.imageUploadService.upload(this.files, this.data.url);
    const allProgressObservables = [];
    for (const key in this.progress) {
      allProgressObservables.push(this.progress[key].progress);
    }

    this.primaryButtonText = 'Finish';

    this.canBeClosed = false;
    this.dialogRef.disableClose = true;

    this.showCancelButton = false;

    forkJoin(allProgressObservables).subscribe({
      next: () => {
        this.canBeClosed = true;
        this.dialogRef.disableClose = true;
        this.uploadSuccessful = true;
        this.uploading = false;
        this.dialogRef.close();
      },
      error: err => {
        console.log(err);
        this.canBeClosed = true;
        this.uploading = false;
        this.uploadSuccessful = false;
        this.progress = null;
      }
    });

  }

  addFiles() {
    this.file.nativeElement.click();
  }

}
