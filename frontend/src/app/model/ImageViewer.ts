import {Image} from "./Responses";
/**
 * Created by brasaeed on 28/06/2019.
 */
export interface ImageViewer {
  title: string;
  images: Image[];
  addCallback: Function;
}
