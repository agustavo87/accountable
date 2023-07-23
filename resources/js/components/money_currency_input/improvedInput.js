export default class ImprovedInput {
    /**
     * 
     * @param {HTMLInputElement} input 
     * @param {object} locale 
     */
    constructor(input, locale) {
        this.locale = locale
        this.input = input
        this.initValue = input.value
        this._cursor = input.selectionStart
        this.lastSegment = this.initValue.slice(this.cursor)
        this.firstSegment = this.initValue.slice(0,this.cursor)
    }
    
    get value() {
        return this.input.value
    }

    set value(v) {
        this.input.value = v
    }

    static positionWithoutThousands(position, inSegment) {
        return position - this.thousandsSignsIn(inSegment)
    }

    thousandsSignsIn(segment) {
        let segmentThousands = segment.match(this.locale.thousandsRegExp)
        return segmentThousands ? segmentThousands.length : 0
    }

    positionWithoutThousands(position, inSegment) {
        return position - this.thousandsSignsIn(inSegment)
    }

    get cursorIsOnFractionSide() {
        return this.firstSegment.includes(this.locale.decimal)
    }

    get cursor() {
        return this._cursor
    }

    set cursor(position) {
        this.input.selectionStart = this.input.selectionEnd = position
    }

    get empty() {
        return !this.initValue.length
    }

    toStandardDecimalForFormater(number) {
        return this.replaceCommasForDots(this.removeThousands(number))
    }

    replaceCommasForDots(segment) {
        return segment.replace(',', '.')
    }

    removeThousands(segment) {
        return segment.replaceAll(this.locale.thousands, '')
    }
}