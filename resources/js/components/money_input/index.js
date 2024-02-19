
import MoneyInput from "./moneyInputDecorator";
import onAmountInput from "./onAmountInput";
import setupLocale from "./setupLocale";

export default (opts) => ({
    currencyParameters: opts.currencyParameters,
    _amount: opts.amount,
    lang: opts.lang,
    placeholder: '0.00',
    nf: null,
    get amountInput() {
        return this.$refs.amount
    },
    set standardDecimalAmount(amount)
    {
        this._amount = amount
    },
    init: function () {
        this.$watch('currencyParameters', (newValue, oldValue) => {
            this.setupLocale()
            if(!this.amountInput) {
                /** Don't know why some times there is no amount input - Alpine fail?*/
                // console.warn('no amount input!', newValue, oldValue, this.amountInput)
                return
            }
            this.formatInput()
        })

        this.setupLocale()
    },
    updatedInput() {
        this.setupLocale()
        this.amountInput.value = this.format(this._amount)
    },

    setupLocale() {
        const localeData = setupLocale(this.lang, this.currencyParameters.scale)

        this.nf = localeData.nf
        this.locale = localeData.locale
        this.placeholder = localeData.placeholder

        return;
    },
    inputAmount(event) {
        onAmountInput(this.amountInput, this.locale, event, this);
    },

    format(number) {
        return number ? this.nf.format(number): null
    },

    reformatInput(onAmount) {
        onAmount.value =  this.format(onAmount.toStandardDecimal(onAmount.compound)) 
        onAmount.cursor = onAmount.calculateCurosrPosition((number) => this.format(number))
    },

    formatInput() {
        const amount = new MoneyInput(this.amountInput, this.locale)
        amount.value = this.format(amount.toStandardDecimal(amount.value))
        this.standardDecimalAmount = amount.toStandardDecimal(amount.value)
    },
})