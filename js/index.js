var express = require("express");
var app = express();
var connection = require("./app.js");

app.use(express.static(__dirname + "/html"));
app.get("/", (req, res) => {
  res.render("~/cychess-emu-website/html/main.html");
});

app.listen(5005, () => {
  console.log("Server is running on port");
  connection.connect((err) => {
    if (err) {
      console.log(err);
    } else {
      console.log("db connected..");
    }
  });
});
