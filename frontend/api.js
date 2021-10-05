import axios from 'axios'
import Cookies from 'js-cookie'

export default {
    init() {
        axios.defaults.baseURL = '/api/';
        axios.defaults.headers.common['Content-Type'] = 'application/json';
        axios.defaults.headers.common['Accept'] = 'application/json';
        axios.defaults.headers.common['X-CSRF-Token'] = Cookies.get('csrfToken');
    },

    get(resource, icao, options = {}) {
        return axios.get(`${resource}/${icao}`, options);
    },
};