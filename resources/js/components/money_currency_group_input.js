
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
    isFunctionalKey(onAmount) {
        const code = onAmount.code
        return code.includes('Enter')
            || code.includes('Backspace')
            || code.includes('Arrow')
    },
    get amountInput() {
        return this.$refs.amount
    },
    suspendBackspace(onAmount) {
        return onAmount.code.includes('Backspace') && onAmount.firstSegment.at(-1) == this.thousands
    },
    inputAmount(event) {

        const onAmount = this.onAmount(event)

        if (this.isFunctionalKey(onAmount)) {
            if(this.suspendBackspace(onAmount)) {
                event.preventDefault()
                onAmount.setCursor(onAmount.cursor - 1)
            } else {
                this.$nextTick(() => {
                    const _onAmount = this.onAmount(event)
                    _onAmount.input.value = _onAmount.value.length ? this.nf.format(this.removeThousands(_onAmount.value)) : ''
                    if(_onAmount.code.includes('Backspace')) {
                        _onAmount.setCursor(this.calculateCursorPositionAfterBackspace(_onAmount))
                    }
                })
            }
            return
        }
        
        event.preventDefault()

        if(this.isNumberOrDecimal(onAmount)) {
            
            if(this.decimalAgain(onAmount)) return

            if(this.afterDecimal(onAmount)) {
                onAmount.input.value = onAmount.compound
                onAmount.setCursor(onAmount.cursor + 1)
                return
            }
            this.reformatInput(onAmount)
        }
    },
    decimalAgain(onAmount) {
        return onAmount.key == this.decimal && onAmount.value.includes(this.decimal)
    },
    isNumberOrDecimal(onAmount) {
        return /\d/.test(onAmount.key) || onAmount.key == this.decimal
    },
    afterDecimal(onAmount) {
        return onAmount.firstSegment.includes(this.decimal)
    },
    onAmount(event) {
        const result =  {
            input:this.amountInput,
            value: this.amountInput.value,
            cursor: this.amountInput.selectionStart,
            setCursor(position) {
                this.input.selectionStart = this.input.selectionEnd = position
            }
        }
        result.lastSegment = result.value.slice(result.cursor)
        result.firstSegment = result.value.slice(0,result.cursor)
        if(event) {
            result.key = event.key
            result.code = event.code
            result.compound = result.firstSegment + result.key + result.lastSegment
        }
        return result
    },
    reformatInput(onAmount) {
        this.amount =  this.nf.format(this.removeThousands(onAmount.compound)) + 
            // Chequea si el ultimo caracter es un punto, para agregarlo luego que es removido por el formato.
            (this.finalDecimal(onAmount.compound) ? this.decimal : '') 

        onAmount.input.value = this.amount

        onAmount.input.selectionStart = onAmount.input.selectionEnd = this.calculateCurosrPosition(onAmount)
    },
    formatInput() {
        this.amountInput.value = this.nf.format(this.removeThousands(this.amountInput.value))
    },
    calculateCurosrPosition(onAmount) {
        let intialPosition = this.positionWithoutThousands(onAmount.firstSegment.length, onAmount.firstSegment) + 1
        let newFirstSegment = this.removeThousands(onAmount.compound).slice(0, intialPosition + 1)
        return intialPosition + Math.floor((newFirstSegment.split(this.decimal)[0].length - 1) / 3)
    },
    calculateCursorPositionAfterBackspace(onAmount) {
        return Math.max(0, onAmount.cursor + (this.thousandsSignsIn(onAmount.input.value) - this.thousandsSignsIn(onAmount.value)))
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
        return segment.at(- 1) == this.decimal
    },
})