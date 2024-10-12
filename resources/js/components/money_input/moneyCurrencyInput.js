import MoneyInput from "./moneyInputDecorator";
import onAmountInput from "./onAmountInput";
import setupLocale from "./setupLocale";

export default (opts) => ({
    currencyOptions: opts.currencyOptions,
    cryptoCurrencyOptions: opts.cryptoCurrencyOptions,
    currencyParameters: opts.currencyParameters,
    currency: opts.currency,
    currencyType: opts.currencyType,
    _currency: '',
    _currencyType: '',
    currencyHint: opts.currencyHint,
    errors: opts.errors,
    _amount: opts.amount,
    lang: opts.lang,
    scale: opts.scale,
    placeholder: '0.00',
    nf: null,
    get amountInput() {
        return this.$refs.amount
    },
    get hasCurrencyError() {
        return this.errors.hasOwnProperty('currency')
    },
    get showCurrencies() {
        return !this._hideCurrencies && (this.onCurrencyInput || this.onCurrenciesList);
    },
    set standardDecimalAmount(amount)
    {
        this._amount = amount
    },
    onCurrencyInput:false,
    onCurrenciesList:false,
    _hideCurrencies: false,
    hideCurrencies: function () {
        this._hideCurrencies = true
        this.onCurrenciesList = false
        window.setTimeout(() => {
            this._hideCurrencies = false
        }, 500);
    },
    setCurrency: function(code) {
        /**
         * @todo Hacer que el setting the una currency sea mediante un método
         * porque se necesita el código y el tipo de currency, y si no, se debe
         * actualizar las propiedades una a la vez, en orden (primero el tipo y luego el código)
         * en distintas requests. Hay que modificar
         *  - setCurrency
         *  - setCriptoCurrency
         *  - $watch('showCurrencies', (showCurrencies) => {...}
         */
        this._currency = code
        this._currencyType = 'fiat'
        this.currencyHint = code
        this.hideCurrencies()
    },
    setCriptoCurrency: function(code) {
        console.log('selected crypto currency', code)
        this._currencyType = 'crypto'
        this._currency = code
        this.currencyHint = code
        this.hideCurrencies()
    },
    init: function () {
        this.setupLocale()
        this.$refs.currencyInput.value = this._currency = this.currency
        this._currencyType = this.currencyType
        this.$refs.currencyInput.value = this.currency
        this.$watch('currency', (v) => {
            this.$refs.currencyInput.value = v
 
        })
        this.$watch('currencyParameters', () => {
            this.setupLocale()
            this.formatInput()
        })
        this.$watch('showCurrencies', (showCurrencies) => {
            if(!showCurrencies) {
                this.$refs.currencyInput.value = this._currency
                this.currencyType = this._currencyType
                this.currency = this._currency
            }
        })
    },
    setupLocale() {
        const localeData = setupLocale(this.lang, this.currencyParameters.scale)

        this.nf = localeData.nf
        this.locale = localeData.locale
        this.placeholder = localeData.placeholder
        
        return;
    },
    inputAmount(event) {
        onAmountInput(this.amountInput, this.locale, event, this)
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