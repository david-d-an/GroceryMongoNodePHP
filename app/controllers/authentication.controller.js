const Customer = require('../models/customer.model');
const dbConfig = require("../../config/database.config.js");
const mongoose = require("mongoose");
const bcrypt = require('bcrypt');

/***********/
var options = {
  useFindAndModify: dbConfig.useFindAndModify,
  useNewUrlParser: dbConfig.useNewUrlParser
};
mongoose
.connect(dbConfig.url, options)
.then(console.log("Successfully connected to the Grocery database from Customer Controller"))
.catch(err => {
  console.log("Could not connect to the database. Exiting now...", err);
  process.exit();
});
/***********/

exports.get = (req,res) => {
  // var postalCode = parseFloat(req.params.password);
  // if (isNaN(postalCode))
  //   var postalParam = req.params.password;
  // else
  //   var postalParam = postalCode;


  // Customer
  // .find()
  // .stream()
  // .on('data', (customer) => {
  //   var postalCode = "";
  //   if (customer.PostalCode && customer.PostalCode != "NULL"){
  //     postalCode = "" + customer.PostalCode;
  //   }

  //   bcrypt.hash(postalCode, 10, (err, hash) => {
  //     Customer.findByIdAndUpdate(
  //       customer._id,
  //       { $set: { Password: hash }},
  //       (err, res) => {
  //         if (err)
  //           console.log(err);
  //       }
  //     );
  //   });
  // })
  // .on('end', () => {
  //   console.log("All updated")
  // });

  // Customer.findById(req.params.CustomerID)
  Customer.findOne(
    { CustomerID: req.params.userid },
    (err, user) => {
      if (err) {
        console.log(err.message);
        res.status(500).send({ message: err.message });
      }

      console.log(req.params.userid);
      console.log(req.params.password);

      if (user){
        bcrypt.compare(req.params.password, user.Password, (err, same) => {
          // console.log(user);
          if (same){
            console.log("Password match");
            res.json(user);
          }
          else{
            console.log("Password mismatch");
            res.json([]);
          }
        })  
      }
      else{
        console.log("User doesn't exist.");
        res.json([]);
      }
    }
  );
};

exports.post = (req,res) => {
  if (!req.body.sku)
    res.status(400).send({message: "SKU is missing."});
    
  var customer = new Customer({
    CustomerID: req.body.CustomerID,
    CompanyName: req.body.CompanyName,
    ContactName: req.body.ContactName,
    ContactTitle: req.body.ContactTitle,
    Address: req.body.Address,
    City: req.body.City,
    Region: req.body.Region,
    PostalCode: req.body.PostalCode,
    Country: req.body.Country,
    Phone: req.body.Phone,
    Fax: req.bod.Faxy
  });

  customer
  .save()
  .then(c => {
    res.status(200).send({message:"Successfully created", customer:c})
  })
  .catch(err=> res.status(500).send({message: err.message}));
};

exports.put = (req,res) => {
  if (!req.body.sku)
    return res.send({message: "SKU is missing"});
  else if (!req.body.name)
    return res.send({message: "Name is missing"});
  else if (!req.body.description)
    return res.send({message: "Description is missing"});

    Customer.findByIdAndUpdate(req.params.id,
    {
      CustomerID: req.body.CustomerID,
      CompanyName: req.body.CompanyName,
      ContactName: req.body.ContactName,
      ContactTitle: req.body.ContactTitle,
      Address: req.body.Address,
      City: req.body.City,
      Region: req.body.Region,
      PostalCode: req.body.PostalCode,
      Country: req.body.Country,
      Phone: req.body.Phone,
      Fax: req.bod.Faxy
    },
    { new: true }
  )
  .then(c => {
    if (!c)
      return res.status(400).send({
        message: "Customer couldn't be found"
      });
    else
      res.status(200).send({message:"Successfully updated", customer:c});
  })
  .catch(err => res.send({message: err.message}));
};
