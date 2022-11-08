import './bootstrap';
import('preline');

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'
Alpine.plugin(persist)
import Main  from './components/main';




Alpine.data('Main', Main)


window.Alpine = Alpine;

Alpine.start();


