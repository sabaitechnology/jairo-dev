function ip2long(IP) { // allows decimal, octal, and hexadecimal and between 1 (e.g. 127) to 4 (e.g 127.0.0.1) components.
  // http://kevin.vanzonneveld.net
  // +   original by: Waldo Malqui Silva
  // +   improved by: Victor
  // +    revised by: fearphage (http://http/my.opera.com/fearphage/)
  // +    revised by: Theriault
  // PHP.js under the MIT license (http://phpjs.org/about)
 var i = 0;  
 IP = IP.match(/^([1-9]\d*|0[0-7]*|0x[\da-f]+)(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?(?:\.([1-9]\d*|0[0-7]*|0x[\da-f]+))?$/i); // Verify IP format.
 if (!IP) return false; // Invalid format.
 IP[0] = 0;  // Reuse IP variable for component counter.
 for(i=1; i<5; i++){
  IP[0] += !! ((IP[i] || '').length);
  IP[i] = parseInt(IP[i]) || 0;
 }
 IP.push(256, 256, 256, 256); // Overflow values;
 IP[4 + IP[0]] *= Math.pow(256, 4 - IP[0]); // Recalculate overflow of last component supplied to make up for missing components.
 if (IP[1] >= IP[5] || IP[2] >= IP[6] || IP[3] >= IP[7] || IP[4] >= IP[8]) return false;

 return ( IP[1] * (IP[0] === 1 || 16777216) + IP[2] * (IP[0] <= 2 || 65536) + IP[3] * (IP[0] <= 3 || 256) + IP[4] * 1 );
}

function long2ip(ip) {
  // http://kevin.vanzonneveld.net
  // +   original by: Waldo Malqui Silva
  // +   modified to one-liner by David@Sabai
  // PHP.js under the MIT license (http://phpjs.org/about)
  return ( !isFinite(ip) ? false : [ip >>> 24, ip >>> 16 & 0xFF, ip >>> 8 & 0xFF, ip & 0xFF].join('.'));
}

function cidr2mask(cidr){ return long2ip( ( cidr<=0 || cidr > 32)?0:( -1 << 32-cidr ) ); }
function mask2cidr(mask){ if(typeof mask !=='string'){ return 0; }; mask = mask.split('.'); var cidr=0, n=0; while(n=mask.shift()) while(n>0){ n = ((n<<1) % 256); cidr++; }; return cidr; }

function padString(pad, length){ var padstr = ''; while(length-->0){ padstr += pad; }; return padstr; }

function mac2long(value){ return ( (typeof value === "string") ? parseInt(value.replace(/:/g,''),16) : value ); }
function long2mac(value){ var v = value.toString(16); return (padString('0',12-v.length) + v).match(/.{0,2}/g).slice(0,-1).join(':'); }
