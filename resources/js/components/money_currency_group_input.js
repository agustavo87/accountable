
export default (opts) => ({
    currencyOptions: opts.currencyOptions,
    currency: opts.currency,
    _currency: '',
    currencyHint: opts.currencyHint,
    errors: opts.errors,
    amount: opts.amount,
    lang: opts.lang,
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
            this.decimal = ','
            this.thousands = '.'
            this.decimalRegExp = /,/g
            this.thousandsRegExp = /\./g
            return
        } 
        this.decimal = '.'
        this.thousands = ','
        this.decimalRegExp = /\./g
        this.thousandsRegExp = /,/g
    },
    nf: new Intl.NumberFormat(opts.lang),
    aFunctionalKeyIsPressed(onAmount) {
        const code = onAmount.code
        return code.includes('Enter')
            || code.includes('Backspace')
            || code.includes('Arrow')
    },
    get amountInput() {
        return this.$refs.amount
    },
    isErasingAThousand(onAmount) {
        return onAmount.code.includes('Backspace') && onAmount.firstSegment.at(-1) == this.thousands
    },
    inputAmount(event) {

        const onAmount = this.improveInput(this.amountInput, event)

        if (this.aFunctionalKeyIsPressed(onAmount)) {
            if(this.isErasingAThousand(onAmount)) {
                event.preventDefault()
                onAmount.cursor--
            } else {
                this.$nextTick(() => {
                    const _onAmount = this.improveInput(this.amountInput, event)
                    _onAmount.input.value = _onAmount.value.length ? this.format(_onAmount.value) : ''
                    if(_onAmount.code.includes('Backspace')) {
                        _onAmount.cursor = this.calculateCursorPositionAfterBackspace(_onAmount)
                    }
                })
            }
            return
        }
        
        event.preventDefault()

        if(this.aNumberOrDecimalIsPressed(onAmount)) {
            
            if(this.aDecimalIsPressedAgain(onAmount)) return
            if(onAmount.key == this.decimal) {
                onAmount.input.value = this.format(onAmount.firstSegment) + onAmount.key + this.removeThousands(onAmount.lastSegment)
                onAmount.cursor++
                return
            }
            if(this.cursorIsOnFractionSide(onAmount)) {
                onAmount.input.value = onAmount.compound
                onAmount.cursor++
                return
            }
            this.reformatInput(onAmount)
        }
    },
    aDecimalIsPressedAgain(onAmount) {
        return onAmount.key == this.decimal && onAmount.value.includes(this.decimal)
    },
    aNumberOrDecimalIsPressed(onAmount) {
        return /\d/.test(onAmount.key) || onAmount.key == this.decimal
    },
    cursorIsOnFractionSide(onAmount) {
        return onAmount.firstSegment.includes(this.decimal)
    },
    improveInput(input, event) {
        const result =  {
            input:input,
            value: input.value,
            _cursor: input.selectionStart,
            get cursor() {return this._cursor},
            set cursor(position) {
                this.input.selectionStart = this.input.selectionEnd = position
            },
        }
        result.lastSegment = result.value.slice(result.cursor)
        result.firstSegment = result.value.slice(0,result.cursor)
        if(event) {
            result.code = event.code
            result._key = event.key
            result.key = event.code.includes('Decimal') ? this.decimal : result._key
            result.compound = result.firstSegment + result.key + result.lastSegment
        }
        return result
    },
    format(number) {
        return this.nf.format(this.replaceCommasForDots(this.removeThousands(number)))
    },
    reformatInput(onAmount) {
        this.amount =  this.format(onAmount.compound)
        onAmount.input.value = this.amount
        onAmount.cursor = this.calculateCurosrPosition(onAmount)
    },
    replaceCommasForDots(segment) {
        return segment.replace(',', '.')
    },
    formatInput() {
        this.amountInput.value = this.nf.format(this.replaceCommasForDots( this.removeThousands(this.amountInput.value)))
    },
    calculateCurosrPosition(onAmount) {
        let intialPosition = this.positionWithoutThousands(onAmount.firstSegment.length, onAmount.firstSegment) + 1
        let newFirstSegment = this.removeThousands(onAmount.compound).slice(0, intialPosition + 1)
        return intialPosition + this.estimateThousands(newFirstSegment)
    },
    estimateThousands(segment) {
        let formated = this.nf.format(segment)
        let thousands = formated.match(this.thousandsRegExp)
        return thousands ? thousands.length : 0
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
         let segmentThousands = segment.match(this.thousandsRegExp)
         return segmentThousands ? segmentThousands.length : 0
    },
    finalDecimal(segment) {
        return segment.at(- 1) == this.decimal
    },
})