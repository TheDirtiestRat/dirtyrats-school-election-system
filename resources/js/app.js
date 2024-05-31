import './bootstrap';

import './niceapp.js';
// import '../css/niceapp.css';

import '../sass/app.scss';

// import bootstrap from 'bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import jQuery from 'jquery';
window.$ = jQuery;

import Alert from 'bootstrap/js/dist/alert';

// or, specify which plugins you need:
import { Tooltip, Toast, Popover } from 'bootstrap';