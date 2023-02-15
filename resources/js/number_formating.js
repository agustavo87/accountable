const cachedNF = {
    cached:false,
    nf:null,
    currencyCode: null,
    locale: null,
    supportedCodes: ['USD', 'ARS', 'EUR']
}

export function setSuportedCodes(codes) {
    cachedNF.supportedCodes = codes
    console.log(cachedNF);
}
/**
 * @returns {Intl.NumberFormat}
 */
export default (currencyCode, locale = 'en-US') => {
    currencyCode = currencyCode ?? 'USD'
    if (!cachedNF.supportedCodes.includes(currencyCode)) {
        // console.warn('currency unkown ' + currencyCode + "\n Known: ", JSON.stringify(cachedNF.supportedCodes))
        currencyCode = 'USD'
    } 
    if(
        cachedNF.cached 
        && cachedNF.currencyCode == currencyCode
        && cachedNF.locale == locale
    ) return cachedNF.nf
    cachedNF.nf = new Intl.NumberFormat(locale, {
        style: "currency",
        currency: currencyCode,
        maximumFractionDigits: 2,
        roundingIncrement: 5,
        currencyDisplay: "narrowSymbol",
    })
    cachedNF.cached = true
    return cachedNF.nf
};