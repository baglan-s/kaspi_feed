import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import Menubar from 'primevue/menubar';
import Toolbar from 'primevue/toolbar';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';
import Toast from 'primevue/toast';

export default function ({app}) {
    app.component('Dialog', Dialog);
    app.component('Button', Button);
    app.component('Menubar', Menubar);
    app.component('Toolbar', Toolbar);
    app.component('DataTable', DataTable);
    app.component('Column', Column);
    app.component('ColumnGroup', ColumnGroup);
    app.component('Row', Row);
    app.component('Toast', Toast);
}