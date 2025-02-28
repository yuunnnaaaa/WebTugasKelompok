const mysql = require('mysql')

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'weblanjutan'
});

db.connect( err => {
	if(err){
		console.error(" Koneksi database error" + err)
	}

	else{
		console.log('Koneksi database berhasil')
	}


})

module.exports = db