export default function (lang, scale ) {
    const nf = new Intl.NumberFormat(lang, {
        maximumFractionDigits: scale
    })

    // formatter to extract localized stuff
    const nf2 = new Intl.NumberFormat(lang)
    const parts = nf2.formatToParts(25325.5);   // just some random number with some 
                                                // decimal and numbers to group
    const decimal = parts.find(part => part.type == 'decimal').value
    const thousands = parts.find(part => part.type == 'group').value
    
    const locale = {
        decimal: decimal,
        thousands: thousands,
        decimalRx: new RegExp(`\\${decimal}`, 'g'),
        thousandsRx: new RegExp(`\\${thousands}`, 'g')
    }
    
    // a formater for the placeholder
    const placeholder = Intl.NumberFormat(lang, {
        minimumFractionDigits: scale
    }).format(0);

    return {locale, nf, placeholder};
}