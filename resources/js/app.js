import './bootstrap';

import Alpine from 'alpinejs';
import Main  from './components/main';

Alpine.data('Main', Main)


window.Alpine = Alpine;

Alpine.start();


