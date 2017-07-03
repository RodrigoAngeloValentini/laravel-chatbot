import Example from './components/Example.vue'
import Login from './components/Login.vue'

export default [
    {
        path: '/',
        component: Example,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login,
        meta: {
            requiresAuth: false
        }
    }
]