import './bootstrap';
import('preline');

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'
Alpine.plugin(persist)
import {Main}  from './components/main';
import {Wire} from "./components/wire";




Alpine.data('Main', Main)
Alpine.data('Wire', Wire)


window.Alpine = Alpine;

Alpine.start();


