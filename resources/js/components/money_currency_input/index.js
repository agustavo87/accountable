
import KeyPressedOnImprovedInput from "./KeyPressedOnImprovedImput";
import ImprovedInput from "./improvedInput";

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

        const onAmount = new KeyPressedOnImprovedInput(this.amountInput, this.locale, event)

        if (onAmount.aFunctionalKeyIsPressed) {
            if(onAmount.isErasingAThousand) {
                // we don't want to erase thousands groups, just jump over them.
                onAmount.keyEvent.preventDefault()
                onAmount.cursor--
                return
            } 
            // After the default event handler has made effect.
            this.$nextTick(() => {
                const _onAmount = new KeyPressedOnImprovedInput(this.amountInput, this.locale, event)
                _onAmount.value = !_onAmount.empty ? this.format(_onAmount.toStandardDecimalForFormater(_onAmount.initValue)) : ''
                if(_onAmount.pressed('Backspace')) {
                    _onAmount.cursor = _onAmount.calculateCursorPositionAfterBackspace()
                }
            })
            return
        }
        
        onAmount.keyEvent.preventDefault()

        if(onAmount.aValidNumericKeyIsPressed) {
            if(onAmount.aDecimalIsPressed) {
                if(onAmount.aDecimalIsPresent) return
                onAmount.value = this.format(onAmount.toStandardDecimalForFormater(onAmount.firstSegment)) + onAmount.key + this.removeThousands(onAmount.lastSegment)
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

    toStandardDecimalForFormater(number) {
        return this.replaceCommasForDots(this.removeThousands(number))
    },

    reformatInput(onAmount) {
        onAmount.value =  this.format(onAmount.toStandardDecimalForFormater(onAmount.compound)) 
        onAmount.cursor = this.calculateCurosrPosition(onAmount)
    },

    replaceCommasForDots(segment) {
        return segment.replace(',', '.')
    },

    formatInput() {
        const amount = new ImprovedInput(this.amountInput, this.locale)
        amount.value = this.format(amount.toStandardDecimalForFormater(amount.value))
    },

    calculateCurosrPosition(onAmount) {
        let intialPosition = onAmount.positionWithoutThousands(onAmount.firstSegment.length, onAmount.firstSegment) + 1
        let newFirstSegment = this.removeThousands(onAmount.compound).slice(0, intialPosition + 1)
        return intialPosition + this.estimateThousands(newFirstSegment)
    },

    estimateThousands(segment) {
        let formated = this.nf.format(segment)
        let thousands = formated.match(this.locale.thousandsRegExp)
        return thousands ? thousands.length : 0
    },

    removeThousands(segment) {
        return segment.replaceAll(this.locale.thousands, '')
    },
})