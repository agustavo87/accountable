import nf from "../number_formating";
export default (opts) => ({
    operations: opts.entangles.operations,
    pagination: opts.entangles.pagination,
    locale: opts.locale,
    formatNumber(number, currency) {
        return nf(currency, this.locale).format(number)
    }
});