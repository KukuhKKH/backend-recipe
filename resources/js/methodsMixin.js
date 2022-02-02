export default {
    route: window.route,
    textLimiterFilter: (value) => {
        return value.substr(0, 30) + '...'
    },
    dateFilter: (value) => {
        return moment(value).format('LL LT')
    },
    capitalizeFilter: (value) => {
        return value.charAt(0).toUpperCase() + value.slice(1)
    },
    moneyFilter: (value) => {
        let number_string = value.toString().replace(/[^,\d]/g, '')
        let split = number_string.split(',')
        let sisa = split[0].length % 3
        let rupiah = split[0].substr(0, sisa)
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi)
        if(ribuan) {
            let seperator = sisa ? '.' : ''
            rupiah += seperator + ribuan.join('.')
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
        return 'Rp. ' + rupiah + ',-'
    }
}
