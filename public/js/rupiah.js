/*
        Write by Muhammad Khairuddin aka Omjoko
        Description : This function to convert integer to Masking Rupiah Curency
        Created Date 29/03/2017
*/

function toRp(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
}

function toAngka(rp){return parseInt(rp.replace(/,.*|\D/g,''),10)}