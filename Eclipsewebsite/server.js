const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const db = require('./db');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');
const { Parser } = require('json2csv');

const app = express();
app.use(express.static(__dirname));
app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

const SECRET = 'yourSuperSecretKey'; // Replace with a secure key or use .env

// Define your admin credentials
const adminUser = {
  username: 'robertja',
  passwordHash: bcrypt.hashSync('Ecl1pse', 10) // Replace with your actual password
};

// Save contact submissions
app.post('/api/contact', (req, res) => {
  const { name, email, company, message } = req.body;
  const submittedAt = new Date().toISOString();

  db.run(`INSERT INTO contacts (name, email, company, message, submittedAt) VALUES (?, ?, ?, ?, ?)`,
    [name, email, company, message, submittedAt],
    function (err) {
      if (err) return res.status(500).json({ error: 'Database error' });
      res.status(200).json({ message: 'Submission saved', id: this.lastID });
    });
});

// Login route
app.post('/api/admin/login', (req, res) => {
  const { username, password } = req.body;

  if (username !== adminUser.username || !bcrypt.compareSync(password, adminUser.passwordHash)) {
    return res.status(401).json({ error: 'Invalid credentials' });
  }

  const token = jwt.sign({ username }, SECRET, { expiresIn: '2h' });
  res.json({ token });
});

// Token verification
app.listen(3000, () => console.log('CRM server running on http://localhost:3000'));

