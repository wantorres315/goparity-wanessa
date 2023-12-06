import { createRouter, createWebHistory } from 'vue-router'

import amortizationIndex from '../components/amortizations/index.vue'

import amortizationPaid from '../components/amortizations/paid.vue'

import projectIndex from '../components/projects/index.vue'

import notFound from '../components/NotFound.vue'


const routes = [
    {
        path: '/',
        component: amortizationIndex
    }, {
        path: '/projects/:projectId',
        component: projectIndex,
        props: true,
    },{
        path: '/amortizations/paid',
        component: amortizationPaid,
        
    },
   
    {
        path: '/:patchMatch(.*)*',
        component: notFound
    }
]
const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router