class HttpService {
  apiUrl = 'http://poster.dev';

  getUrl(route) {
    return `${this.apiUrl}${route}`;
  }

  getPayload(method, data) {
    return {
      method,
      data,
      mode: 'no-cors',
    };
  }

  get() {}
  delete() {}
  patch() {}
  post(route, data) {
    return fetch(this.getUrl(route), this.getPayload('POST', data));
  }
}

export default new HttpService();
