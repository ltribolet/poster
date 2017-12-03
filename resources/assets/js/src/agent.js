import axios from 'axios';
import queryString from 'query-string';

const api = axios.create({
  baseURL: getAPIUrl(),
});

function getAPIUrl() {
  const developmentUrl = 'http://poster.dev';
  const isProduction = process.env.NODE_ENV === 'production';
  if (isProduction) {
    // return queryString.parse(location.search)['api-url'] || productionUrl;
  } else {
    const search = location.hash.slice(location.hash.indexOf('?'));
    return queryString.parse(search)['api-url'] || developmentUrl;
  }
}
