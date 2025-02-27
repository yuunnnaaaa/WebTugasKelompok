function prosesData() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            console.log('Akun Anda Sedang Diproses');
            resolve({status :'Akun Anda Sudah Terdaftar'});
        }, 2000)
    })
}

function saveData(status) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            console.log('Memproses ', status );
            resolve('Success');
        }, 2000)
    })
}
async function output(params) {
    try{
        const sukses =await prosesData();
        const sukses2 = await saveData(sukses);

        console.log(sukses2, 'Silahkan Masuk Dengan Akun Baru Anda');
    } catch (error) {
        console.log('Coba Daftarkan Lagi Akun Anda');
    }
}
output()
