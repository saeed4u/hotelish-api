import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RoomTypeDialogComponent } from './roomtypedialog.component';

describe('RoomTypeDialogComponent', () => {
  let component: RoomTypeDialogComponent;
  let fixture: ComponentFixture<RoomTypeDialogComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RoomTypeDialogComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RoomTypeDialogComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
