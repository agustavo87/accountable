import moneyFormat from "../money_format"

export default (opts) => ({
    get formated() {
        if (!('currencyCode' in this.$el.dataset)) return ''

        const mf =  moneyFormat({
            code: this.$el.dataset.currencyCode,
            scale: this.$el.dataset.scale,
            locale: this.$el.dataset.locale
        })
        return mf.format(this.$el.dataset.amount)
        
    }
})