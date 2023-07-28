
import KeyPressedOnMoneyInput from "./KeyPressedOnMoneyInput";
import MoneyInput from "./moneyInput";

export default (opts) => ({
    currencyOptions: opts.currencyOptions,
    currency: opts.currency,
    _currency: '',
    currencyHint: opts.currencyHint,
    errors: opts.errors,
    amount: opts.amount,
    lang: opts.lang,
    nf: new Intl.NumberFormat(opts.lang),
    get amountInput() {
        return this.$refs.amount
    },
    get hasCurrencyError() {
        return this.errors.hasOwnProperty('currency')
    },
    get showCurrencies() {
        return !this._hideCurrencies && (this.onCurrencyInput || this.onCurrenciesList);
    },    
    onCurrencyInput:false,
    onCurrenciesList:false,
    _hideCurrencies: false,
    hideCurrencies: function () {
        this._hideCurrencies = true
        window.setTimeout(() => {
            this._hideCurrencies = false
        }, 500);
    },
    setCurrency: function(code) {
        this._currency = code
        this.hideCurrencies()
    },
    init: function () {
        this.setupLocale()
        this.$watch('currency',v => this.$refs.currencyInput.value = v)
        this.$watch('showCurrencies', (v) => {
            if(!v) {
                this.$refs.currencyInput.value = this._currency
                this.currency = this._currency
            }
        })
    },
    setupLocale() {
        if(this.lang.includes('es')) {
            this.locale = {
                decimal: ',',
                thousands: '.',
                decimalRegExp: /,/g,
                thousandsRegExp: /\./g,
            }
            return
        } 
        this.locale = {
            decimal: '.',
            thousands :',',
            decimalRegExp: /\./g,
            thousandsRegExp: /,/g,
        }
    },
    inputAmount(event) {

        const onAmount = new KeyPressedOnMoneyInput(this.amountInput, this.locale, event)

        if (onAmount.aFunctionalKeyIsPressed) {
            if(onAmount.isErasingAThousand) {
                // we don't want to erase thousands groups, just jump over them.
                onAmount.keyEvent.preventDefault()
                onAmount.cursor--
                return
            } 
            // After the default event handler has made effect.
            this.$nextTick(() => {
                const _onAmount = new KeyPressedOnMoneyInput(this.amountInput, this.locale, event)
                _onAmount.value = !_onAmount.empty ? this.format(_onAmount.toStandardDecimalForFormater(_onAmount.initValue)) : ''
                if(_onAmount.pressed('Backspace')) {
                    _onAmount.cursor = _onAmount.calculateCursorPositionAfterBackspace()
                    return
                }
                _onAmount.cursor = _onAmount.cursor
            })
            return
        }
        
        onAmount.keyEvent.preventDefault()

        if(onAmount.aValidNumericKeyIsPressed) {
            if(onAmount.aDecimalIsPressed) {
                if(onAmount.aDecimalIsPresent) return
                onAmount.value = this.format(onAmount.toStandardDecimalForFormater(onAmount.firstSegment)) + onAmount.key + onAmount.removeThousands(onAmount.lastSegment)
                onAmount.cursor++
                return
            }

            if(onAmount.cursorIsOnFractionSide) {
                onAmount.value = onAmount.compound
                onAmount.cursor++
                return
            }
            
            this.reformatInput(onAmount)
            this.amount = onAmount.value
        }
    },

    format(number) {
        return this.nf.format(number)
    },

    reformatInput(onAmount) {
        onAmount.value =  this.format(onAmount.toStandardDecimalForFormater(onAmount.compound)) 
        onAmount.cursor = onAmount.calculateCurosrPosition((number) => this.format(number))
    },

    formatInput() {
        const amount = new MoneyInput(this.amountInput, this.locale)
        amount.value = this.format(amount.toStandardDecimalForFormater(amount.value))
    },
})