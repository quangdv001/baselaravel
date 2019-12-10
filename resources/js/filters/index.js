// set function parseTime,formatTime to filter
export { parseTime, formatTime } from '@/utils';

export function convertToDatetime(date) {
  const d = new Date(date)
  let month = '' + (d.getMonth() + 1)
  let day = '' + d.getDate()
  const year = d.getFullYear()
  let hour = '' + d.getHours()
  let minute = '' + d.getMinutes()
  let second = '' + d.getSeconds()

  if (month.length < 2) month = '0' + month
  if (day.length < 2) day = '0' + day
  if (hour.length < 2) hour = '0' + hour
  if (minute.length < 2) minute = '0' + minute
  if (second.length < 2) second = '0' + second

  return [hour, minute, second].join(':') + ' ' + [day, month, year].join('/')
}
export function convertToDate(date) {
  const d = new Date(date)
  let month = '' + (d.getMonth() + 1)
  let day = '' + d.getDate()
  const year = d.getFullYear()

  if (month.length < 2) month = '0' + month
  if (day.length < 2) day = '0' + day

  return [day, month, year].join('/')
}

export function pluralize(time, label) {
  if (time < 1) {
    return 'Vừa tạo';
  }
  if (time === 1) {
    return time + label;
  }
  return time + label + '';
}

export function timeAgo(time) {
  const between = Date.now() / 1000 - Number(time);
  if (between < 3600) {
    return pluralize(~~(between / 60), ' phút');
  } else if (between < 86400) {
    return pluralize(~~(between / 3600), ' giờ');
  } else {
    return pluralize(~~(between / 86400), ' ngày');
  }
}

/* Number formating*/
export function numberFormatter(num, digits) {
  const si = [
    { value: 1E18, symbol: 'E' },
    { value: 1E15, symbol: 'P' },
    { value: 1E12, symbol: 'T' },
    { value: 1E9, symbol: 'G' },
    { value: 1E6, symbol: 'M' },
    { value: 1E3, symbol: 'k' },
  ];
  for (let i = 0; i < si.length; i++) {
    if (num >= si[i].value) {
      return (num / si[i].value + 0.1).toFixed(digits).replace(/\.0+$|(\.[0-9]*[1-9])0+$/, '$1') + si[i].symbol;
    }
  }
  return num.toString();
}

export function toThousandFilter(num) {
  return (+num || 0).toString().replace(/^-?\d+/g, m => m.replace(/(?=(?!\b)(\d{3})+$)/g, ','));
}

export function uppercaseFirst(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

export function formatMoney(number, floatNumber = false) {
  number = parseFloat(number.toString().match(/^-?\d+\.?\d{0,2}/))
  // Seperates the components of the number
  let components = (Math.floor(number * 100) / 100).toString().split('.')
  if (number < 0) {
    components = components = (Math.floor(Math.abs(number) * 100) / 100 * -1).toString().split('.')
  }
  // Comma-fies the first part
  components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.')
  // Combines the two sections
  if (!floatNumber) return components[0]
  return components.join(',')
}
