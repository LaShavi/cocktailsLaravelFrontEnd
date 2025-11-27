import './bootstrap';

import Alpine from 'alpinejs';
import jQuery from 'jquery';
import DataTable from 'datatables.net-dt';
import Swal from 'sweetalert2';

// Hacer librerías disponibles globalmente
window.$ = jQuery;
window.jQuery = jQuery;
window.DataTable = DataTable;
window.Swal = Swal;

window.Alpine = Alpine;

Alpine.start();
