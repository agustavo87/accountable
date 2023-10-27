import MoneyInput from "./moneyInputDecorator"

export default class KeyPressedOnMoneyInput extends MoneyInput {
    /**
     * 
     * @param {HTMLInputElement} input 
     * @param {object} locale 
     * @param {KeyboardEvent} keyEvent 
     */
    constructor(input, locale, keyEvent ) {
        super(input, locale)
        
        this.keyEvent = keyEvent
        this.code = keyEvent.code
        this._key = keyEvent.key
        this.key = keyEvent.code.includes('Decimal') ? this.locale.decimal : this._key
        this.compound = this.firstSegment + this.key + this.lastSegment    
    }
    
    get aFunctionalKeyIsPressed() {
        return this.code.includes('Enter')
            || this.code.includes('Backspace')
            || this.code.includes('Arrow')
    }
    
    get isErasingAThousand () {
        return this.code.includes('Backspace') && this.firstSegment.at(-1) == this.locale.thousands
    }

    jumpOnePositionBack() {
        this.keyEvent.preventDefault()
        this.cursor--
    }

    pressed (keyName) {
        return this.code.includes(keyName)
    }

    preventDefault() {
        this.keyEvent.preventDefault()
    }

    calculateCursorPositionAfterBackspace() {
        return Math.max(0, this.cursor + (this.thousandsSignsIn(this.value) - this.thousandsSignsIn(this.initValue)))
    }

    get aValidNumericKeyIsPressed() {
        return /^\d$/.test(this.key) || this.key == this.locale.decimal
    }

    get aDecimalIsPressed() {
        return this.key == this.locale.decimal;
    }

    get aDecimalIsPresent() {
        return this.initValue.includes(this.locale.decimal)
    }
    
    get aDecimalIsPressedAgain() {
        return this.key == this.locale.decimal && this.initValue.includes(this.locale.decimal)
    }

    calculateCurosrPosition(format) {
        let intialPosition = this.positionWithoutThousands(this.firstSegment.length, this.firstSegment) + 1
        let newFirstSegment = this.removeThousands(this.compound).slice(0, intialPosition + 1)
        return intialPosition + this.estimateThousands(newFirstSegment, format)
    }
}