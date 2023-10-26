
import KeyPressedOnMoneyInput from "./keyPressedOnMoneyInput";
import MoneyInput from "./moneyInput";

export default (opts) => ({
    currencyOptions: opts.currencyOptions,
    currencyParameters: opts.currencyParameters,
    currency: opts.currency,
    _currency: '',
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
    set formatedAmount(amount)
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
        this._currency = code
        this.currencyHint = code
        this.hideCurrencies()
    },
    init: function () {
        this.setupLocale()
        this.$refs.currencyInput.value = this._currency = this.currency
        this.$refs.currencyInput.value = this.currency
        this.$watch('currency', (v) => {
            this.$refs.currencyInput.value = v
 
        })
        this.$watch('currencyParameters', () => {
            this.setupLocale()
            this.formatInput()
        })
        this.$watch('showCurrencies', (v) => {
            if(!v) {
                this.$refs.currencyInput.value = this._currency
                this.currency = this._currency
            }
        })
    },
    setupLocale() {
        // formatter to format input
        this.nf = new Intl.NumberFormat(this.lang, {
            maximumFractionDigits: this.currencyParameters.scale
        })

        // formatter to extract localized stuff
        const nf2 = new Intl.NumberFormat(this.lang)
        const parts = nf2.formatToParts(25325.5);   // just some random number with some 
                                                    // decimal and numbers to group
        const decimal = parts.find(part => part.type == 'decimal').value
        const thousands = parts.find(part => part.type == 'group').value
        
        this.locale = {
            decimal: decimal,
            thousands: thousands,
            decimalRx: new RegExp(`\\${decimal}`, 'g'),
            thousandsRx: new RegExp(`\\${thousands}`, 'g')
        }
        
        // a formater for the placeholder
        this.placeholder = Intl.NumberFormat(this.lang, {
            minimumFractionDigits: this.currencyParameters.scale
        }).format(0);
        return;
    },
    inputAmount(event) {

        const onAmount = new KeyPressedOnMoneyInput(this.amountInput, this.locale, event)

        if (onAmount.aFunctionalKeyIsPressed) {
            if(onAmount.isErasingAThousand) {
                // we don't want to erase thousands groups, just jump over them.
                onAmount.jumpOnePositionBack()
                return
            } 
            // After the default event handler has made effect.
            this.$nextTick(() => {
                // new instance with previous event, but updated imput
                const _onAmount = new KeyPressedOnMoneyInput(this.amountInput, this.locale, event)
                _onAmount.value = !_onAmount.empty ? this.format(_onAmount.toStandardDecimal(_onAmount.initValue)) : ''
                this.formatedAmount = _onAmount.toStandardDecimal(_onAmount.value)
                if(_onAmount.pressed('Backspace')) {
                    _onAmount.cursor = _onAmount.calculateCursorPositionAfterBackspace()
                    return
                }
                _onAmount.cursor = _onAmount.cursor
            })
            return
        }
        
        onAmount.preventDefault()

        if(onAmount.aValidNumericKeyIsPressed) {
            if(onAmount.aDecimalIsPressed) {
                if(onAmount.aDecimalIsPresent) return
                onAmount.value = this.format(onAmount.toStandardDecimal(onAmount.firstSegment)) + onAmount.key + onAmount.removeThousands(onAmount.lastSegment)
                if(onAmount.lastSegment) {
                    // if there's something at the right of the decimal sign.
                    this.formatedAmount = onAmount.toStandardDecimal(onAmount.value)
                }
                onAmount.cursor++
                return
            }

            if(onAmount.cursorIsOnFractionSide) {
                onAmount.value = onAmount.compound
                // only save if the fractional part is inbound of scale
                if(onAmount.partsOf(onAmount.value).fractional.length <= this.scale) {
                    this.formatedAmount = onAmount.toStandardDecimal(onAmount.value)
                }
                onAmount.cursor++
                return
            }

            this.reformatInput(onAmount)
            this.formatedAmount = onAmount.toStandardDecimal(onAmount.value)
        }
    },

    format(number) {
        return this.nf.format(number)
    },

    reformatInput(onAmount) {
        onAmount.value =  this.format(onAmount.toStandardDecimal(onAmount.compound)) 
        onAmount.cursor = onAmount.calculateCurosrPosition((number) => this.format(number))
    },

    formatInput() {
        const amount = new MoneyInput(this.amountInput, this.locale)
        amount.value = this.format(amount.toStandardDecimal(amount.value))
        this.formatedAmount = amount.toStandardDecimal(amount.value)
    },
})