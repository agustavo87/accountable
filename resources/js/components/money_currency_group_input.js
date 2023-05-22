
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
    inputAmount(event) {
        // Allow only digits and comma input
        // and other auxiliary keys.
        const {key,code} = event
        const input = this.$refs.amount;
        const cursorPos = input.selectionStart
        const nf = new Intl.NumberFormat();

        
        if (   code.includes('Enter')
            || code.includes('Backspace')
            || code.includes('Arrow')
            ) {
            this.$nextTick(() => {
                input.value = nf.format(input.value.replaceAll(this.thousands, ''))
            })
            return
        }
        event.preventDefault()
        if(
               /\d/.test(key)
            || key == this.decimal
        ) {
            
            let value = input.value
            let lastSegment = value.slice(cursorPos)
            let firstSegment = value.slice(0,cursorPos)
            // Only one decimal separator
            if(key == this.decimal && value.includes(this.decimal)) return

            let composite = firstSegment + key + lastSegment

            this.amount =  nf.format(this.removeThousands(composite)) + 
                // Chequea si el ultimo caracter es un punto, para agregarlo luego que es removido por el formato.
                (this.finalDecimal(composite) ? this.decimal : '') 
            input.value = this.amount

            input.selectionStart = input.selectionEnd = this.calculateCurosrPosition(firstSegment, composite)
        }
    },
    calculateCurosrPosition(firstSegment, composite) {
        let intialPosition = this.positionWithoutThousands(firstSegment.length, firstSegment) + 1
        let newFirstSegment = this.removeThousands(composite).slice(0, intialPosition + 1)
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