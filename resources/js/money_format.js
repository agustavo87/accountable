export default function (data) {
    // console.log('money format...', data)
    const locale = data.locale ?? 'es-AR'
    return Intl.NumberFormat(locale , {
        style:'currency',
        currency: data.code,
        currencyDisplay: 'code',
        maximumFractionDigits: data.scale
    });
}