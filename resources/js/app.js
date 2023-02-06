import './bootstrap';
// import './tailwindui/_components'

import menu from './tailwindui/components/menu'

import Alpine from 'alpinejs'
 
window.Alpine = Alpine
 
Alpine.data('menu', menu)

Alpine.start()
