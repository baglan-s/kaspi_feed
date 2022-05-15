import RequestHelper from 'Helpers/RequestHelper';

export default class AuthService {
    login(email, password) {
        return RequestHelper.post('login', {
            email: email,
            password: password,
        }, false)
    }
    logout() {
        return RequestHelper.post('logout')
    }
    register(data = {}) {
        return RequestHelper.post('register', data, false)
    }
    authenticated() {
        return RequestHelper.get('authenticated')
    }
}