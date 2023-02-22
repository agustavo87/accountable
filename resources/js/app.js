import './bootstrap';
import './tailwindui/_components'

import OperationsList from './components/operations_list'
import OperationsTable from './components/operations_table'
import OperationsOverview from './components/operations_overview'
import CreateCategoryModal from './components/create_category_modal';

import menu from './tailwindui/components/menu'

import Alpine from 'alpinejs'

import { setSuportedCodes } from './number_formating';
 
window.Alpine = Alpine
 
Alpine.data('menu', menu)
Alpine.data('OperationsList', OperationsList)
Alpine.data('OperationsTable', OperationsTable)
Alpine.data('OperationsOverview', OperationsOverview)
Alpine.data('CreateCategoryModal', CreateCategoryModal)

window.setCurrencyCodes(setSuportedCodes);

Alpine.start()
