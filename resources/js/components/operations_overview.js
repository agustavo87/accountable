import nf from '../number_formating'

export default (opts) => ({
    kpi: opts.entangles.kpi,
    locale: opts.locale,
    init() {
        this.nf = nf(this.kpi.account.currency, this.locale )
    },
    formatNumber(n) {
        return this.nf.format(n)
    }
});