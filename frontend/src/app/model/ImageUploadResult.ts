import {Observable} from "rxjs/index";
export interface FileUploadResult {
  [key: string]: { progress: Observable<number> };
}
