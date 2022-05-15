export default ({ store, next }) => {
    // if (!store.getters.getCurrentUser) {
    if (!localStorage.getItem('api_token')) {
      next('/login')

      return false
    }
    next()
}