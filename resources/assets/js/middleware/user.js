export default ({ store, next }) => {
    // if (store.getters.getCurrentUser) {
    if (localStorage.getItem('api_token')) {
      next('/')

      return false
    }
    next()
}