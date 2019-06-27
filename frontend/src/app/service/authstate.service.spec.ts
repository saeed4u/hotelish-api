import { TestBed } from '@angular/core/testing';

import { AuthStateService } from './authstate.service';

describe('AuthStateService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: AuthStateService = TestBed.get(AuthStateService);
    expect(service).toBeTruthy();
  });
});
