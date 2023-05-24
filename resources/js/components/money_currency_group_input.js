
export default (opts) => ({
    currencyOptions: opts.currencyOptions,
    currency: opts.currency,
    _currency: '',
    currencyHint: opts.currencyHint,
    errors: opts.errors,
    amount: opts.amount,
    decimal: opts.decimal,
    thousands: opts.thousands,
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
    get hasCurrencyError() {
        return this.errors.hasOwnProperty('currency')
    },
    get showCurrencies() {
        return !this._hideCurrencies && (this.onCurrencyInput || this.onCurrenciesList);
    },
    init: function () {
        this.$watch('currency',v => this.$refs.currencyInput.value = v)
        this.$watch('showCurrencies', (v) => {
            if(!v) {
                this.$refs.currencyInput.value = this._currency
                this.currency = this._currency
            }
        })
    },
    nf: new Intl.NumberFormat(),
    isFunctionalKey(event) {
        const code = event.code
        return code.includes('Enter')
            || code.includes('Backspace')
            || code.includes('Arrow')
    },
    get amountInput() {
        return this.$refs.amount
    },
    inputAmount(event) {
        if (this.isFunctionalKey(event)) {
            this.$nextTick(() => {
                this.amountInput.value = this.amountInput.value.length ? this.nf.format(this.removeThousands(this.amountInput.value)) : ''
            })
            return
        }
        event.preventDefault()
        if(
               /\d/.test(event.key)
            || event.key == this.decimal
        ) {
            const onAmount = this.onAmount(event)
            // Only one decimal separator
            if(onAmount.key == this.decimal && onAmount.value.includes(this.decimal)) return

            if(this.proceedToFormat(onAmount)) {
                this.reformatInput(onAmount)
            } else {
                onAmount.input.value = onAmount.compound
            }
        }
    },
    proceedToFormat(onAmount) {
        if (!onAmount.firstSegment.includes(this.decimal)) return true
        return false
    },
    onAmount(event) {
        const result =  {
            value: this.amountInput.value,
            cursor: this.amountInput.selectionStart,
            input:this.amountInput,
            key: event.key
        }
        result.lastSegment = result.value.slice(result.cursor)
        result.firstSegment = result.value.slice(0,result.cursor)
        result.compound = result.firstSegment + result.key + result.lastSegment
        return result
    },
    reformatInput(onAmount) {
        this.amount =  this.nf.format(this.removeThousands(onAmount.compound)) + 
        // Chequea si el ultimo caracter es un punto, para agregarlo luego que es removido por el formato.
        (this.finalDecimal(onAmount.compound) ? this.decimal : '') 
        this.amountInput.value = this.amount

        this.amountInput.selectionStart = this.amountInput.selectionEnd = this.calculateCurosrPosition(onAmount)
    },
    formatInput() {
        this.amountInput.value = this.nf.format(this.removeThousands(this.amountInput.value))
    },
    calculateCurosrPosition(onAmount) {
        let intialPosition = this.positionWithoutThousands(onAmount.firstSegment.length, onAmount.firstSegment) + 1
        let newFirstSegment = this.removeThousands(onAmount.compound).slice(0, intialPosition + 1)
        return intialPosition + Math.floor((newFirstSegment.split(this.decimal)[0].length - 1) / 3)
    },
    removeThousands(segment) {
        return segment.replaceAll(this.thousands, '')
    },
    positionWithoutThousands(position, inSegment) {
        return position - this.thousandsSignsIn(inSegment)
    },
    thousandsSignsIn(segment) {
         let segmentThousands = segment.match(new RegExp(this.thousands, 'g'))
         return segmentThousands ? segmentThousands.length : 0
    },
    finalDecimal(segment) {
        return segment.charAt(segment.length - 1) == this.decimal
    },
})