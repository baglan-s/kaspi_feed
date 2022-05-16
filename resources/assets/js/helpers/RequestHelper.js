const axios = require('axios').default;
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

const RequestHelper = {
    request: axios.create({
        baseURL: 'http://91.201.215.157/api/',
        timeout: 5000,
        headers: {'Content-Type': 'application/json'}
    }),
    authorizeParams(params = {}) {
        params.api_token = localStorage.getItem('api_token');
        return params;
    },
    get(uri, params = {}, authotize = true) {
        if (authotize) {
            params = this.authorizeParams(params);
        }

        uri = uri + '?' + new URLSearchParams(params).toString()

        return this.request.get(uri)
    },
    post(uri, params = {}, authotize = true) {
        if (authotize) {
            params = this.authorizeParams(params);
        }

        return this.request.post(uri, params)
    },
    put(uri, params = {}, authotize = true) {
        if (authotize) {
            params = this.authorizeParams(params);
        }

        return this.request.put(uri, params)
    },
    delete(uri, params = {}, authotize = true) {
        if (authotize) {
            params = this.authorizeParams(params);
        }

        uri = uri + '?' + new URLSearchParams(params).toString()

        return this.request.delete(uri)
    }
}

export default RequestHelper;