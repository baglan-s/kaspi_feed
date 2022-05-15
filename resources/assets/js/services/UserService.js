import RequestHelper from 'Helpers/RequestHelper';

export default class UserService {
    getAll() {
        return RequestHelper.get('users')
    }

    create(user) {
        return RequestHelper.post('users/create', user);
    }

    update(user) {
        return RequestHelper.put('users/update/' + user.id, user);
    }

    get(id) {
        return RequestHelper.get('users/show/' + id);
    }

    delete(id) {
        return RequestHelper.delete('users/delete/' + id);
    }
}