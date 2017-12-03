import { ReduceStore } from 'flux/utils';
import { SIGNIN } from './UserActionTypes';
import Dispatcher from './Disptacher';

class UserStore extends ReduceStore {
  constructor() {
    super(Dispatcher);
  }

  getInitialState() {
    return {
      isSignIn: false,
    };
  }

  reduce(state, action) {
    switch (action.type) {
      case SIGNIN:
        return state;
      default:
        return state;
    }
  }
}

export default new UserStore();
