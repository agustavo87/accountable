import nf from "../number_formating";

export default (opts) => ({
    operations: opts.entangles.operations,
    pagination: opts.entangles.pagination,
    locale: opts.locale,
    border(moveIndex, opIndex, operation) {
        return this.lastMove(moveIndex, operation) && !this.lastOperation(opIndex)
    },
    noPadding(moveIndex, opIndex, operation) {
        return this.lastMove(moveIndex, operation) && !this.lastOperation(opIndex)
    },
    lastMove(moveIndex, operation) {
        return moveIndex == (operation.movements.length - 1)
    },
    lastOperation(opIndex) {
        return opIndex == (this.operations.length - 1)
    },
    formatNumber(currency, n) {
        return nf(currency, this.locale).format(n)
    }
});