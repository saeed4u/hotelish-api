import {Injectable} from "@angular/core";
import {HttpClient, HttpEvent, HttpEventType, HttpRequest, HttpResponse} from "@angular/common/http";
import {FileUploadResult} from "../model/ImageUploadResult";
import {Subject} from "rxjs/index";
import {filter} from "rxjs/internal/operators";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class ImageUploadService {

  constructor(private http: HttpClient) {
  }

  public upload(files: Set<File>, endPoint: string): FileUploadResult {

    const fileUploadStatus: FileUploadResult = {};

    files.forEach((file: File) => {
      const formData: FormData = new FormData();
      formData.append('image', file, file.name);
      const imageRequest = new HttpRequest('POST', `${environment.baseApiUrl}${endPoint}`, formData, {
        reportProgress: true
      });

      const progressSubject = new Subject<number>();

      this.http.request(imageRequest)
        .pipe(filter((event: HttpEvent<any>) => (event.type === HttpEventType.UploadProgress) || (event instanceof HttpResponse)))
        .subscribe({
          next: (event) => {
            if (event.type === HttpEventType.UploadProgress) {
              const percentDone = Math.round((100 * event.loaded) / event.total);
              progressSubject.next(percentDone);
              return;
            }else if(event instanceof HttpResponse) {
              progressSubject.complete();
            }
          }, error: err => {
            progressSubject.error(err);
          },
        });

      fileUploadStatus[file.name] = {
        progress: progressSubject.asObservable()
      };

    });

    return fileUploadStatus;

  }
}
