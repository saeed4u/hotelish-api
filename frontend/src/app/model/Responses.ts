export class BaseResponse {
  status_code: string;
  message: string;
}

export interface User {
  first_name: string;
  last_name: string;
  email: string;
  user_type: string;
  first_login: boolean;
  token: string;
}

export interface Country {
  name: string;
  code: string;
}

export interface Image {
  id: number;
  src: string;
}

export interface RoomType {
  id: number;
  name: string;
  added_by: string;
}

export interface Pricing {
  id: number;
  room_type: RoomType;
  price: string;
  currency: string;
  added_by: string;
}

export interface Booking {
  room: Room;
  user: User;
  pricing: Pricing;
  start_date: string;
  end_date: string;
}

export interface Room {
  id: number;
  name: string;
  created_at: string;
  updated_at: string;
  type: RoomType;
  added_by: string;
  images: Array<Image>;
}

export interface Hotel {
  id: number;
  name: string;
  email: string;
  address: string;
  state: string;
  city: string;
  country: Country;
  zip_code: string;
  phone: string;
  rooms: Array<Room>;
  images: Array<Image>;
}

export class LoginResponse extends BaseResponse {
  public user: User;
}

export class HotelResponse extends BaseResponse {
  public hotel: Hotel;
}

export class RoomTypesResponse extends BaseResponse {
  public room_types: Array<RoomType>;
}

export class RoomTypeResponse extends BaseResponse {
  public room_type: RoomType;
}

export class RoomsResponse extends BaseResponse {
  public rooms: Array<Room>;
}

export class RoomResponse extends BaseResponse {
  public room: Room;
}

export class PricingsResponse extends BaseResponse {
  public pricings: Array<Pricing>;
}

export class PricingResponse extends BaseResponse{
  public pricing: Pricing;
}
