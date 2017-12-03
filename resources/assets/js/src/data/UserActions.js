import { SIGNIN } from './UserActionTypes';
import Dispatcher from './Disptacher';

import HttpService from '../Services/HttpService';
const SIGNIN_ROUTE = '/oauth/token';

export const signinAction = (email, password) => {
  HttpService.post(SIGNIN_ROUTE, { email, password, grant_type: password }).then(response => console.log(response));
  /*   Dispatcher.dispatch({
    type: SIGNIN,
    user,
  }); */
};
