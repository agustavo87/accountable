import { cloneDeep } from "lodash";
import nf from "../number_formating";

export default (opts) => ({
    _operations: opts.entangles.operations,
    pagination: opts.entangles.pagination,
    locale: opts.locale,
    get operations () {
        return cloneDeep(this._operations).reverse()
    }, 
    border(moveIndex, opIndex, operation) {
        return (moveIndex == (operation.movements.length - 1)) && (opIndex != 0) 
    },
    formatNumber(currency, n) {
    return nf(currency, this.locale).format(n)
    }
});