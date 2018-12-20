var auth = require("../controllers/authentication.controller");

module.exports = app => {
  app.get("/authentication/:userid/:password", auth.get);

  app.post("/authentication", auth.post);

  app.put("/authentication/:id", auth.put);
};
