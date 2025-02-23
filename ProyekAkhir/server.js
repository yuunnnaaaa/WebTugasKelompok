const express = require('express');

const app = express();
const db = require('./db')
const bodyParser = require('body-parser');

app.use(express.json());
app.use(bodyParser.json());


app.get('/api/user', (req, res) => {
	let txt = "SELECT * FROM user"

	let params = []
	
	db.query(txt,params, function(err, hasilQuery){
		if(err){
			console.error('Oops, ada query yang error')
			res.status(500)
			res.json({'pesan' : 'Oops, ada query yang error'+err})
			res.end()
		}

		else{
			res.status(200)
			res.json(hasilQuery)
			res.end()
		}
	})
})

app.get('/api/user/:id', (req, res) => {
	let txt = "SELECT * FROM user WHERE id = ?"

	const id_mhs = req.params.id
	db.query(txt,[id_mhs], function(err, hasilQuery){
		if(err){
			console.error('Oops, ada query yang error')
			res.status(500)
			res.json({'pesan' : 'Oops, ada query yang error'+err})
			res.end()
		}

		else{
			res.status(200)
			res.json(hasilQuery)
			res.end()
		}
	})
})

// create data user
app.post('/api/user', (req, res) => {
    const { username, usia, password, diagnosa_penyakit, catatan } = req.body;
const sql = 'INSERT INTO user (username, usia, password, diagnosa_penyakit, catatan) VALUES (?, ?, ?, ?, ?)';

    db.query(sql, [username, usia, password, diagnosa_penyakit, catatan], (err, result) => {
        if (err) {
            res.status(500).json({ error: 'Database error' });
        } else {
            res.status(201).json({ message: 'User baru telah ditambah', id: result.insertId });
        }
    });
});

// update data user
app.put('/api/user/:id', (req, res) => {
    const { username, diagnosa_penyakit, catatan } = req.body;
    const id = req.params.id;
    const sql = 'UPDATE user SET username = ?, diagnosa_penyakit = ?, catatan = ? WHERE id = ?';

    db.query(sql, [username, diagnosa_penyakit, catatan, id], (err, result) => {
        if (err) {
            res.status(500).json({ error: 'Database error' });
        } else if (result.affectedRows === 0) {
            res.status(404).json({ error: 'User not found' });
        } else {
            res.json({ message: 'User telah diupdate' });
        }
    });
});

// delete student
app.delete('/api/user/:id', (req, res) => {
    const id = req.params.id;
    const sql = 'DELETE FROM user WHERE id = ?';

    db.query(sql, [id], (err, result) => {
        if (err) {
            res.status(500).json({ error: 'Database error' });
        } else if (result.affectedRows === 0) {
            res.status(404).json({ error: 'User not found' });
        } else {
            res.json({ message: 'User telah dihapus' });
        }
    });
});


// Start the server
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});

// // Import dependencies
// const express = require('express');
// const mysql = require('mysql');
// const jwt = require('jsonwebtoken');
// const bcrypt = require('bcrypt');
// const fs = require('fs');
// const https = require('https');
// const cors = require('cors');
// const path = require('path');
// const rateLimit = require('express-rate-limit');
// const helmet = require('helmet');

// // Load RSA keys
// const privateKey = fs.readFileSync('./keys/private.pem', 'utf8');
// const publicKey = fs.readFileSync('./keys/public.pem', 'utf8');

// // Initialize Express app
// const app = express();
// app.use(express.json());
// app.use(cors());
// app.use(helmet());
// app.use(express.static(path.join(__dirname, 'public')));

// // Rate Limiting
// const limiter = rateLimit({
//     windowMs: 15 * 60 * 1000, // 15 minutes
//     max: 100, // limit each IP to 100 requests per windowMs
//     message: 'Too many requests from this IP, please try again later'
// });
// app.use(limiter);

// // MySQL Database Connection
// const db = mysql.createConnection({
//     host: 'localhost',
//     user: 'root',
//     password: '',
//     database: 'oauth2_db'
// });

// db.connect(err => {
//     if (err) throw err;
//     console.log('Connected to MySQL Database');
// });

// // User Registration Route
// app.post('/register', async (req, res) => {
//     const { username, password } = req.body;
//     if (!username || !password) return res.status(400).json({ error: 'Username and password are required' });
    
//     const hashedPassword = await bcrypt.hash(password, 12);
//     const query = 'INSERT INTO users (username, password) VALUES (?, ?)';
//     db.query(query, [username, hashedPassword], (err, result) => {
//         if (err) return res.status(500).json({ error: err.message });
//         res.json({ message: 'User registered successfully' });
//     });
// });

// // User Login Route
// app.post('/login', (req, res) => {
//     const { username, password } = req.body;
//     if (!username || !password) return res.status(400).json({ error: 'Username and password are required' });
    
//     const query = 'SELECT * FROM users WHERE username = ?';
//     db.query(query, [username], async (err, results) => {
//         if (err || results.length === 0) return res.status(401).json({ error: 'Invalid credentials' });
        
//         const user = results[0];
//         const passwordMatch = await bcrypt.compare(password, user.password);
//         if (!passwordMatch) return res.status(401).json({ error: 'Invalid credentials' });

//         const token = jwt.sign({ id: user.id, username: user.username }, privateKey, { algorithm: 'RS256', expiresIn: '1h' });
//         res.json({ token });
//     });
// });

// // Token Verification Route
// app.get('/verify', (req, res) => {
//     const token = req.headers['authorization'];
//     if (!token) return res.status(401).json({ error: 'Access denied' });
    
//     jwt.verify(token, publicKey, { algorithms: ['RS256'] }, (err, decoded) => {
//         if (err) return res.status(403).json({ error: 'Invalid token' });
//         res.json({ user: decoded });
//     });
// });

// // Serve Login Popup Form
// app.get('/popup-login', (req, res) => {
//     res.sendFile(path.join(__dirname, 'public', 'popup-login.html'));
// });

// // Logout Route
// app.post('/logout', (req, res) => {
//     res.json({ message: 'User logged out successfully' });
// });

// // Start Server
// const PORT = 3000;
// app.listen(PORT, () => console.log(`Server running on port ${PORT}`));

