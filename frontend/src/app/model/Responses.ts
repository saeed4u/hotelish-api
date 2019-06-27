import {User} from './User';

abstract class BaseResponse {
  status_code: string;
  message: string;
}

export class LoginResponse extends BaseResponse {
    public user: User;
}
