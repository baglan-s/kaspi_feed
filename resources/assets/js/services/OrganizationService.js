import RequestHelper from 'Helpers/RequestHelper';

export default class OrganizationService {
    getAll() {
        return RequestHelper.get('organizations')
    }
    
    get(id) {
        return RequestHelper.get('organizations/show/' + id)
    }

    create(name, description) {
        return RequestHelper.post('organizations/create', {
            name: name,
            description: description
        });
    }

    update(organization) {
        return RequestHelper.put('organizations/update/' + organization.id, {
            name: organization.name,
            description: organization.description
        });
    }

    delete(id) {
        return RequestHelper.delete('organizations/delete/' + id)
    }
}