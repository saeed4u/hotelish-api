import { TestBed } from '@angular/core/testing';

import { AuthstateService } from './authstate.service';

describe('AuthstateService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: AuthstateService = TestBed.get(AuthstateService);
    expect(service).toBeTruthy();
  });
});
