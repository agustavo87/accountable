
import KeyPressedOnMoneyInput from "./keyPressedOnMoneyInput";
import MoneyInput from "./moneyInputDecorator";

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
        this.$watch('currencyParameters', () => {
            this.setupLocale()
            this.formatInput()
        })
        this.setupLocale()
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
                this.standardDecimalAmount = _onAmount.toStandardDecimal(_onAmount.value)
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
                    this.standardDecimalAmount = onAmount.toStandardDecimal(onAmount.value)
                }
                onAmount.cursor++
                return
            }

            if(onAmount.cursorIsOnFractionSide) {
                onAmount.value = onAmount.compound
                // only save if the fractional part is inbound of scale
                if(onAmount.partsOf(onAmount.value).fractional.length <= this.scale) {
                    this.standardDecimalAmount = onAmount.toStandardDecimal(onAmount.value)
                }
                onAmount.cursor++
                return
            }

            this.reformatInput(onAmount)
            this.standardDecimalAmount = onAmount.toStandardDecimal(onAmount.value)
        }
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