import { TestBed } from '@angular/core/testing';

import { ImageUploadService } from './imageupload.service';

describe('ImageUploadService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ImageUploadService = TestBed.get(ImageUploadService);
    expect(service).toBeTruthy();
  });
});
