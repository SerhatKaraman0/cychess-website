const mysql = require("mysql");

require("dotenv").config();

const connection = mysql.createConnection({
  host: "localhost",
  database: "cychessdb",
  user: "root",
  password: process.env.DB_PASSWORD,
});

module.exports = connection;
